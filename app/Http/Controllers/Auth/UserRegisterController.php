<?php

namespace App\Http\Controllers\Auth;

use App\City;
use App\User;
use App\Brand;
use App\Store;
use App\UserStore;
use App\SignupQuestion;
use App\SignupResponse;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Components\FlashMessages;
use App\Http\Requests\UserRegister;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MailController;

class UserRegisterController extends Controller
{
    //

    use FlashMessages;

    public function showRegisterForm(){

        // $restaurents = Store::all();
        $cities = City::all();
        $brands = Brand::all();

        $cities->load('stores');

        $questions = SignupQuestion::all();

        return view('auth.user.register', compact(['cities', 'brands', 'questions']));
    }

    /*
    *
    * Register user
    *
    */
    function checkDateFormat($date)
    {
      // match the format of the date
      if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts))
      {
    
        // check whether the date is valid or not
        if (checkdate($parts[2],$parts[3],$parts[1])) {
          return true;
        } else {
          return false;
        }
    
      } else {
        return false;
      }
    }
    public function register(UserRegister $request){
        // UserRegister

        // $date = Carbon::parse('2018-03-16 15:45')->locale('vi');

        // return $date->translatedFormat('g:i a l jS F Y'); //3:45 ch thứ sáu 16 tháng 3 2018
       
        // $request->validate();
     
        // return $request->all();
      
        $dob = $request->date_of_birth;
        if($this->checkDateFormat($dob)){

            $dobArr = explode("-", $dob);
  
            $dob = $dobArr[2] . '/' . $dobArr[1] . '/' . $dobArr[0];
           
        }
     
        $locale = App::getLocale();
     
        $date = Carbon::createFromFormat('d/m/Y', $dob)->toDateString();
      
        // $datefm = $date->format('Y-m-d');
        
        // return $date;

        // $city = City::where('id', $request->city)->firstOrFail();
       
     
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

        $user->name              =  $request->name;
        $user->email             =  $request->email;
        $user->address           =  $request->address;
        $user->phone_number      =  $request->phone_number;
        $user->day_of_birth      =  $date;
        $user->gender            =  $request->gender;
        $user->password          =  Hash::make($password);
        $user->token             =  Str::random(80);
        $user->actived           =  0;
        $user->user_type         = 'register';
        $user->locale            =   $locale;
        // $user->store_id          =  0;
        // $user->region_id         =  $city->region->id;
        // $user->brand_id          =  $data_user['brand'];
        // $user->city_id           =  $data_user['city'];
        $user->save();



        
        if($user != null){
            //save user to user stores registration after add user
            $storeRegistration = new UserStore();
            $storeRegistration->user_id = $user->id;
            $storeRegistration->stores = $request->store;
            $storeRegistration->locale = $locale;
            $storeRegistration->response_status = 'waiting';
            $storeRegistration->save();
    

            //save question responve from user register
            $signupRespose = new SignupResponse();
    
            $responses = $request->responses;
            $dataInsert = array();

            foreach($responses as $key => $res){
                $dataInsert[$key]['user_id'] = $user->id;
                $dataInsert[$key]['answer'] = $res['answer'];
                $dataInsert[$key]['signup_question_id'] = $res['signup_question_id']; 
            }
        
            $signupRespose->insert($dataInsert);

            $file = asset('files/SOP-Mystery-Diner-Procedure-VN.pdf');
            if($user->locale == 'en'){
                $file = asset('files/SOP-Mystery-Diner-Procedure-English.pdf');
            }
            

            //send email notify to user registration and admin.
            MailController::sendSignupEmail($user->name, $user->email, $user->locale, $user->token, $file );
       
            self::success('Registered successful');
            
            return redirect()->route('user.thankyou', [$user->locale, $user->token]);

        }else{

            return redirect()->back();
            
        }
       

    }

    public function thankyou($lang, $token){
      
        $user = User::where('token', $token)->firstOrFail();
        return view('frontend.user.thankyou', compact(['user']));
    }
}

