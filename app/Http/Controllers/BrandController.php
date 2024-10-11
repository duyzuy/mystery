<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\FlashMessages;
use App\Brand;

class BrandController extends Controller
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
        $brands = Brand::all();
        return view('backend.brands.index', compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

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
            'brand_name'    =>  'required',
        ]);
     
        Brand::create([
            'name'  =>  $request->brand_name,
        ]);
     
        // Redirect to the previous page successfully    
        self::success('Add brand success');
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand = Brand::where('id', $id)->firstOrFail();
        return view('backend.brands.edit', compact(['brand']));
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
            'brand_name'    =>  'required',
        ]);

        $brand = Brand::where('id', $id)->firstOrFail();

        $brand->name = $request->brand_name;
        $brand->save();
        self::success('Update brand success');
        return redirect()->route('brands.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $brand = Brand::where('id', $id)->firstOrFail();
        $brand->delete();
        self::success('Delete success');
        return redirect()->back();
    }
}
