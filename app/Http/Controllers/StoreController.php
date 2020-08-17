<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\City;
use App\Store;
use App\Components\FlashMessages;
class StoreController extends Controller
{
    use FlashMessages;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stores = Store::all();
        return view('backend.stores.index', compact(['stores']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();

        return view('backend.stores.create', compact(['cities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
    
        //
        $request->validate([
            'website'           =>  'required',
            'city'              =>  'required',
            'vi_store_name'     =>  'required',
            'vi_store_address'  =>  'required',
            'en_store_name'     =>  'required',
            'en_store_address'  =>  'required',
            'store_image'       =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
       
        $fileName  = 'default.jpg';
        if($request->hasFile('store_image')){

            $image = $request->file('store_image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();

            $imageName = pathinfo($imageName, PATHINFO_FILENAME); //remove extension

            $imgSlug = Str::slug($imageName, '-'); //create image Slug

            $fileName = $imgSlug . '.' . $extension;

            Storage::putFileAs('public/stores', $request->file('store_image'), $fileName); //save in storage directory
            // Image::make($image)->resize(300, 300)->save( storage_path('uploads/store/' . $filename ) );
            // $post->image()->create(['url' => $fileName]);
        }

        $store_data = [
            'store_website'     =>  $request->website,
            'city_id'           =>  $request->city,
            'store_image'       =>  $fileName,
            'vi' => [
                'store_name'            => $request->vi_store_name, 
                'store_address'         => $request->vi_store_address, 
                'store_description'     => $request->vi_store_description, 
            ],
            'en' => [
                'store_name'            => $request->en_store_name, 
                'store_address'         => $request->en_store_address, 
                'store_description'     => $request->en_store_description, 
            ],
        ];

        Store::create($store_data);
        self::success('Create success');
       
        return redirect()->route('stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $store = Store::where('id', $id)->firstOrFail();
        $cities = City::all();
        
        return view('backend.stores.edit', compact(['store', 'cities']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
 
        $request->validate([
            'website'           =>  'required',
            'city'              =>  'required',
            'vi_store_name'     =>  'required',
            'vi_store_address'  =>  'required',
            'en_store_name'     =>  'required',
            'en_store_address'  =>  'required',
            'store_image'       =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

   
        $store_data = [
            'store_website'     =>  $request->website,
            'city_id'           =>  $request->city,
            'vi' => [
                'store_name'            => $request->input('vi_store_name'), 
                'store_address'         => $request->input('vi_store_address'), 
                'store_description'     => $request->input('vi_store_description'), 
            ],
            'en' => [
                'store_name'            => $request->input('en_store_name'), 
                'store_address'         => $request->input('en_store_address'), 
                'store_description'     => $request->input('en_store_description'), 
            ],
        ];


        if($request->hasFile('store_image')){

            $image = $request->file('store_image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();

            $imageName = pathinfo($imageName, PATHINFO_FILENAME); //remove extension

            $imgSlug = Str::slug($imageName, '-'); //create image Slug

            $fileName = $imgSlug . Carbon::now()->timestamp . '.' . $extension;

            Storage::putFileAs('public/stores', $request->file('store_image'), $fileName); //save in storage directory
            // Image::make($image)->resize(300, 300)->save( storage_path('uploads/store/' . $filename ) );
            // $post->image()->create(['url' => $fileName]);

            $store_data['store_image'] = $fileName;
            
        }



        $store = Store::where('id', $id)->firstOrFail();
        $store->update($store_data);

        self::success('Updated success');
        return redirect()->route('stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $store = Store::where('id', $id)->firstOrFail();
        $store->storeTranslation()->delete();
        $store->delete();
        self::success('Deleted success');
        return redirect()->back();
    }
}
