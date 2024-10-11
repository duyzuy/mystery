<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Setting;
use Carbon\Carbon;

use App\Components\FlashMessages;
class SettingController extends Controller
{
    use FlashMessages;
    //
    public function setting(){
        return view('backend.homepage.setting');
    }

    public function sliderIndex(){
        $sliders = Slider::orderBy('sort')->get();
        return view('backend.slider.index', compact('sliders'));

    }

    public function sliderCreate(Request $request){
       
        $request->validate([
            'name'            =>  'required',
            'image'           =>  'required',
        ]);
        
        $sort = 1;
        if($request->sort != null){
            $sort = $request->sort;
        }
       
        $fileName  = 'default.jpg';
        if($request->hasFile('image')){

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();

            $imageName = pathinfo($imageName, PATHINFO_FILENAME); //remove extension

            $imgSlug = Str::slug($imageName, '-'); //create image Slug
            $time = Carbon::now();
            $time = Str::slug($time, '-');
            $fileName = $imgSlug . $time . '.' . $extension;

            Storage::putFileAs('public/slider', $request->file('image'), $fileName); //save in storage directory
            // Image::make($image)->resize(300, 300)->save( storage_path('uploads/store/' . $filename ) );
            // $post->image()->create(['url' => $fileName]);
        }

        Slider::create([
            'name'  =>  $request->name,
            'slug' =>  $fileName,
            'sort'  =>  $sort
        ]);

        $request->session()->flash('success', 'Create success');
        return redirect()->route('manage.slider.index');
    }

    public function sliderEdit(Slider $slider){

        return view('backend.slider.edit', compact('slider'));
    }

    public function sliderUpdate(Request $request, Slider $slider){
        $request->validate([
            'name'            =>  'required',
            'image'           =>  'required',
        ]);
        
        $sort = 1;
        if($request->sort != null){
            $sort = $request->sort;
        }
       
        $fileName  = 'default.jpg';
        if($request->hasFile('image')){

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();

            $imageName = pathinfo($imageName, PATHINFO_FILENAME); //remove extension

            $imgSlug = Str::slug($imageName, '-'); //create image Slug

            $fileName = $imgSlug . '.' . $extension;

            Storage::putFileAs('public/slider', $request->file('image'), $fileName); //save in storage directory
            // Image::make($image)->resize(300, 300)->save( storage_path('uploads/store/' . $filename ) );
            // $post->image()->create(['url' => $fileName]);
        }
        
        
            $slider->name   =  $request->name;
            $slider->slug   =  $fileName;
            $slider->sort   =  $sort;
            $slider->save();

        $request->session()->flash('success', 'Update success');
        return redirect()->route('manage.slider.index');
    }

    public function sliderDelete(Request $request, $id){

        $slider = Slider::where('id', $id)->firstOrFail();
       
        $slider->delete();
        $request->session()->flash('success', 'Delete success');
        return redirect()->back();
    }


    //Homepage config
    public function homepageIndex(){
        $section1 = Setting::where('setting_name', 'section_1')->firstOrFail();
        $footer = Setting::where('setting_name', 'footer')->firstOrFail();
        return view('backend.homepage.index', compact(['section1', 'footer']));
    }

    public function homepageStore(Request $request){
        
       
        $request->validate([
            'section_1.vn.*'    =>  'required',
            'section_1.en.*'    =>  'required',

        ]);
        $data = [
                    [
                        'setting_name'     =>  'section_1',
                        'vi' => [
                            'setting_value' => json_encode([
                                'title'     =>  $request->section_1['vn']['title'],
                                'content'   =>   $request->section_1['vn']['content'],
                            ])
                            
                        ],
                        'en' => [
                            'setting_value' => json_encode([
                                'title'     =>  $request->section_1['en']['title'],
                                'content'   =>   $request->section_1['en']['content'],
                            ])
                        ],
                    ],
                    [
                        'setting_name'     =>  'footer',
                        'vi' => [
                            'setting_value' => json_encode([
                                'content'   =>   $request->footer['vn']['content'],
                            ])
                            
                        ],
                        'en' => [
                            'setting_value' => json_encode([
                                'content'   =>   $request->footer['en']['content'],
                            ])
                        ],
                    ]
        ];

        if(Setting::where('setting_name', 'section_1')->exists()){

            $section1 = Setting::where('setting_name', 'section_1')->firstOrFail();
            $section1->update($data[0]);

            $footer = Setting::where('setting_name', 'footer')->firstOrFail();
            $footer->update($data[1]);

            
        }
        else{

            Setting::create($data);
         
        }

        self::success('Content was Updated');
        // if(Setting::where('setting_name', 'footer')->exists()){

        //     $section1 = Setting::where('setting_name', 'footer')->firstOrFail();
        //     $section1->update($footer);

        //     self::info('Footer was update success');
        // }else{

        //     Setting::create($footer);

        //     self::success('Footer was create success');
        // }
      

        // self::info('Just a plain message.');
        // ;
        // self::warning('Service is currently under maintenance.');
        // self::danger('An unknown error occured.'); 
       
   
        return redirect()->route('manage.homepage.index');
    }
}
