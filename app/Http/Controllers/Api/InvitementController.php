<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Store;
use App\UserStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Components\FlashMessages;
use Illuminate\Support\Str;
class InvitementController extends Controller
{
    //
    use FlashMessages;
    public function invitementById($id){
        
        $invite = UserStore::where('id', $id)->firstOrFail();

        $restaurants = Store::whereIn('id', $invite->stores)->get();
        $dataRs = Array();
        $invitementData = Array();
        $user = Array();

        $user['id'] = $invite->user->id;
        $user['name'] = $invite->user->name;
        $user['email'] = $invite->user->email;
        $user['phone'] = $invite->user->phone_number;

        foreach($restaurants as $key => $restaurant){
            $dataRs[$key]['id'] = $restaurant->id;
            $dataRs[$key]['name'] = $restaurant->store_name;
            $dataRs[$key]['region'] = $restaurant->city->region->name;
            $dataRs[$key]['city'] = $restaurant->city->name;
            $dataRs[$key]['brand'] = $restaurant->brand->name;
        }
        $restaurantConfirm = null;
        if($invite->confirmed == 1){
            $restaurantConfirm = $invite->store_id;
        }
        
        $invitementData['stores'] = $dataRs;
        $invitementData['storeConfirm'] = $restaurantConfirm;
        $invitementData['user'] = $user;
        return response()->json($invitementData, 200);

    }

    public function invitementConfirm(Request $request){
       
       

        $user = User::where('id', $request->userId)->firstOrFail();
       
        if(!$user){
            $data['status'] = 'false';
            $data['message'] = 'User not exists';
            return response()->json($data, 200);
        }
        

            $date = $request->timeCheckin;
            // "Sunday, September 27th 2020, 10:44"
        

            $date = Carbon::create($date)->toDateTimeString();  //return 2020-10-31 23:10:00 format

            if($user->locale == 'vi'){
                $date_send = Carbon::parse($date)->locale('vi');
                $date_send =  $date_send->isoFormat('dddd - Do MMMM, YYYY');
            }else{
                $date_send = Carbon::parse($date)->locale('en');
                $date_send =  $date_send->isoFormat('dddd - MMMM Do, YYYY');
            }
        
           
        
            $userStore = UserStore::where([['user_id', $request->userId], ['id', $request->inviteId]])->firstOrFail(); 
           
            $userStore->store_id = $request->storeId;
            $userStore->confirmed = true;
            $userStore->check_in = $date;
            $userStore->token  =  Str::random(80);
            $userStore->save();


            $store = Store::where('id', $request->storeId)->firstOrFail();

            MailController::sendConfirmRegistrationRestaurent($user->name, $user->email, $date_send, $user->locale, $store, $userStore->token);

          
      
            $data['status'] = 'success';
            $data['storeName'] = $store->translate('en')->store_name;
            return response()->json($data, 200);
    }
}
