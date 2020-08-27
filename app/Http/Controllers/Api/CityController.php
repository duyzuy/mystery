<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CityCollection;
use App\City;
use App\Brand;
use App\Store;

class CityController extends Controller
{
    //
    
    public function cityList (Request $request){
        
        $lang = $request->lang;

        $cities = City::all();
        $data = [];

        foreach($cities as $key => $city){
            $data[$key]['id'] = $city->id;
            $data[$key]['name']   =   $city->translate($lang)->name;
        }
        
        return $data;

      
    }

    public function brandList(Request $request){
    
     
        $brands = Brand::all();
       
      
        $data = [];

        foreach($brands as $key => $brand){
            $data[$key]['id'] = $brand->id;
            $data[$key]['name']   =   $brand->name;
        }
        
        return $data;

    }

    public function restaurentList (Request $request){

        if($request->city == null && $request->brand == null){

            $restaurents = Store::all();

        }elseif($request->city != '' && $request->brand != ''){

            $restaurents = Store::where([
                ['city_id', '=', $request->city ],
                ['brand_id', '=', $request->brand ],
            ])->get();

        }elseif($request->city == null && $request->brand != ''){

            $restaurents = Store::where('brand_id', '=', $request->brand)->get();

        }else{

            $restaurents = Store::where('city_id', '=', $request->city)->get();
            
        }

        $lang = $request->lang;
       
        $data = [];

        foreach($restaurents as $key => $restaurent){
            $data[$key]['id'] = $restaurent->id;
            $data[$key]['name']    =   $restaurent->translate($lang)->store_name;
            $data[$key]['image']   =   asset('storage/stores/' . $restaurent->store_image) ;
            $data[$key]['city']    =   $restaurent->city->translate($lang)->name;
            $data[$key]['brand']   =   $restaurent->brand->name;
            $data[$key]['address']   =   $restaurent->translate($lang)->store_address;
            $data[$key]['website']   =   $restaurent->store_website;
        }
        
        return response()->json($data, 200);
    }
}
