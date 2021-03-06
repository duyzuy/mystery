<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MailController;
use App\User;
use App\Store;
use App\City;
use App\Brand;

use App\Components\FlashMessages;

class UserRegisterController extends Controller
{
    //

    use FlashMessages;

    public function showRegisterForm(){

        // $restaurents = Store::all();
        $cities = City::all();
        $brands = Brand::all();

        $cities->load('stores');

        return view('auth.user.register', compact(['cities', 'brands']));
    }

    /*
    *
    * Register user
    *
    */
    public function register(Request $request){

    
        $data_user = $this->validate( $request, [
            'name'          =>  'required',
            'email'         =>  'required|unique:users,email',
            'phone_number'  =>  'required',
            // 'bill_image'    =>  'required',
            'store'         =>  'required|integer|exists:App\Store,id',
            // 'bill_image.*'  =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand'         =>  'required|integer|exists:App\Brand,id',
            'city'          =>  'required|integer|exists:App\City,id'
        ]);
        
        $city = City::where('id', $request->city)->firstOrFail();
        //auto create password
        if(!empty($request->password)){
            $password = trim($request->password);
        } else {
            $length = 10;
            $keyspace = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;

            for($i = 0; $i < $length; ++$i){
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }
        $user = new User();

        $user->name              =  $data_user['name'];
        $user->email             =  $data_user['email'];
        $user->address           =  $request->address;
        $user->store_id          =  $data_user['store'];
        $user->phone_number      =  $data_user['phone_number'];
        $user->brand_id          =  $data_user['brand'];
        $user->city_id           =  $data_user['city'];
        $user->region_id         =  $city->region->id;
        $user->password          =  Hash::make('password');
        $user->token             =  Str::random(80);
        $user->actived           =  0;

        $user->save();


        // if($request->hasFile('bill_image')){
        //     // image save
        //     $names = [];
        //     $files = [];
            
        //     foreach($request->file('bill_image') as $image){

        //         $extension = $image->getClientOriginalExtension();
        //         $imageName = $image->getClientOriginalName();

        //         $imageName = pathinfo($imageName, PATHINFO_FILENAME); //remove extension

        //         $time = Carbon::now();
        //         $imgSlug = Str::slug($imageName, '-'); //create image Slug

        //         $timeSlug = Str::slug($time, '-');

        //         $fileName = $imgSlug . '-'. $timeSlug . '.' . $extension;
        //         $thumbnail = $imgSlug . '-'. $timeSlug . '-150x150.' . $extension;
        //         Storage::putFileAs('public/bill', $image, $fileName); 
        //         Image::make($image)->fit(150, 150)->save( storage_path('app/public/bill/' . $thumbnail ) );
       
        //         $url = ['original'  =>  $fileName, 'thumbnail' => $thumbnail];
        //         $user->images()->create(
        //             [
        //                 'url' => json_encode($url),
        //                 'name'  =>  $imageName
        //             ]);
             
        //     }
        // };

        if($user != null){

            MailController::sendSignupEmail($user->name, $user->email, $user->token );
       
            self::success('Register success');
            return redirect()->route('user.thankyou', [app()->getLocale(), $user->token]);

        }else{

            return redirect()->back();
            
        }
       

    }

    public function thankyou($lang, $token){
      
        $user = User::where('token', $token)->firstOrFail();
        return view('frontend.user.thankyou', compact(['user']));
    }
}
