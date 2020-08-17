<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CitiesController extends Controller
{
    //

    public function index(){

        $cities = City::all();
     
        return view('backend.cities.index', compact(['cities']));
    }

    public function store(Request $request){
        
        //validation

        $request->validate([
            'vi_city_name'  =>  'required',
            'en_city_name'  =>  'required',
        ]);

        $city_data = [
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
         $request->session()->flash('success', 'Created success');
         return redirect()->route('manage.cities');

    }
    
    public function edit($id){
        $city = City::findOrFail($id);
        return view('backend.cities.edit', compact(['city']));
    }

    public function update($id, Request $request) {

        $this->validate($request, [
            'vi_city_name'  =>  'required',
            'en_city_name'  =>  'required',
        ]);

        $city_data = [
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

        $request->session()->flash('success', 'Updated success');

        return redirect()->route('manage.cities');
    }


    public function destroy(Request $request, $id)
    {
        //
  
        $city = City::where('id', $id)->firstOrFail();
        $city->cityTranslation()->delete();
        $city->delete();
        $request->session()->flash('success', 'Delete comment success');
        return redirect()->back();
    }
}
