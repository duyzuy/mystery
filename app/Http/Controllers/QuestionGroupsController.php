<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionGroup;

class QuestionGroupsController extends Controller
{
    //

    public function index(){
        $groups = QuestionGroup::all();
        return view('backend.questiongroup.index', compact('groups'));
    }

    public function edit(QuestionGroup $group){

        return view('backend.questiongroup.edit', compact(['group']));
    }

    public function update(Request $request, QuestionGroup $group){
       
        $this->validate($request, [
            'vi_group_name'  =>  'required',
            'en_group_name'  =>  'required',
        ]);

        $data = [
            'vi' => [
                'title'       => $request->input('vi_group_name'),
            ],
            'en' => [
                'title'       => $request->input('en_group_name'), 
            ]
         ];
    

        $group->update($data);
    
        // Redirect to the previous page successfully    

        $request->session()->flash('success', 'Updated success');

        return redirect()->route('manage.questiongroup.index');
    }
 
    public function store( Request $request){

        $this->validate($request, [
            'vi_group_name'  =>  'required',
            'en_group_name'  =>  'required',
        ]);

        $data = [
            'vi' => [
                'title'       => $request->input('vi_group_name'),
            ],
            'en' => [
                'title'       => $request->input('en_group_name'), 
            ]
         ];
     
         // Now just pass this array to regular Eloquent function and Voila!    
         QuestionGroup::create($data);
     
         // Redirect to the previous page successfully    
         $request->session()->flash('success', 'Created success');
         return redirect()->route('manage.questiongroup.index');
    }

    public function destroy(Request $request,  QuestionGroup $group)
    {
        //
        $group->questionGroupsTranslation()->delete();
        $group->delete();
        $request->session()->flash('success', 'Delete comment success');
        return redirect()->back();
    }
}
