<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Region;
use App\Components\FlashMessages;
class CitiesController extends Controller
{
    //
    use FlashMessages;

    public function index(){

        $cities = City::all();
        $regions = Region::all();
        return view('backend.cities.index', compact(['cities', 'regions']));
    }

    public function store(Request $request){
        
        //validation
      
        $request->validate([
            'vi_city_name'  =>  'required',
            'en_city_name'  =>  'required',
            'region'        =>  'required',
        ]);

        $city_data = [
            'region_id'     =>  $request->region,
            'en' => [
                'name'       => $request->input('en_city_name'), 
            ],
            'vi' => [
                'name'       => $request->input('vi_city_name'),
            ],
         ];
     
         // Now just pass this array to regular Eloquent function and Voila!    
         City::create($city_data);
     
         // Redirect to the previous page successfully    
         self::success('Add City success');
         return redirect()->route('manage.cities');

    }
    
    public function edit($id){
        $city = City::findOrFail($id);
        $regions = Region::all();
        return view('backend.cities.edit', compact(['city', 'regions']));
    }

    public function update($id, Request $request) {

        $this->validate($request, [
            'vi_city_name'  =>  'required',
            'en_city_name'  =>  'required',
            'region'        =>  'required',
        ]);

        $city_data = [
            'region_id'     =>  $request->region,
            'en' => [
                'name'       => $request->input('en_city_name'), 
            ],
            'vi' => [
                'name'       => $request->input('vi_city_name'),
            ],
         ];
    
        $city = City::findOrFail($id);

        $city->update($city_data);
    
        // Redirect to the previous page successfully    

        self::success('Update success');

        return redirect()->route('manage.cities');
    }


    public function destroy(Request $request, $id)
    {
        //
  
        $city = City::where('id', $id)->firstOrFail();
        $city->cityTranslation()->delete();
        $city->delete();
        self::success('Add City success');
        return redirect()->back();
    }
}
