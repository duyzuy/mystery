<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    //

    public function index(){
        $questionnaires = Questionnaire::all();
        return view('backend.questionnaires.index', compact(['questionnaires']));
    }

    public function create(){
        return view('backend.questionnaires.create');
    }

    public function store(Request $request){

        $request->validate([
            'en_title'  =>  'required',
            'vi_title'  =>  'required',
        ]);

        $data_questionnaire = [
            'user_id'   =>  Auth::user()->id,
            'vi'    =>  [
                'title' =>  $request->vi_title,
                'description' =>  $request->vi_description,
            ],
            'en'    =>  [
                'title' =>  $request->en_title,
                'description' =>  $request->en_description,
            ],
        ];

        Questionnaire::create($data_questionnaire);
        
        $request->session()->flash('success', 'create questionnaire success');
        return redirect()->back();
    }

    public function edit($id){

       

        $questionnaire = Questionnaire::where('id', $id)->firstOrfail();

        return view('backend.questionnaires.edit', compact('questionnaire'));


    }

    public function update(Request $request, $id){

        
        $request->validate([
            'en_title'  =>  'required',
            'vi_title'  =>  'required',
        ]);
        
        $questionnaire = Questionnaire::where('id', $id)->firstOrFail();

        $data_questionnaire = [
            'user_id'   =>  $questionnaire->user_id,
            'vi'    =>  [
                'title' =>  $request->vi_title,
                'description' =>  $request->vi_description,

            ],
            'en'    =>  [
                'title' =>  $request->en_title,
                'description' =>  $request->en_description,
            ],
        ];
        $questionnaire = Questionnaire::where('id', $id)->firstOrFail();
        $questionnaire->update($data_questionnaire);
        
        $request->session()->flash('success', 'Update questionnaire success');
        return redirect()->route('manage.questionnaire.index');
    }

    public function destroy(Request $request, $id)
    {
        //
        $questionnaire = Questionnaire::where('id', $id)->firstOrFail();
        $questionnaire->questionnaireTranslation()->delete();
        $questionnaire->delete();
        $request->session()->flash('success', 'Delete success');
        return redirect()->back();
    }

    
}
