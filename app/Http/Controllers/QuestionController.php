<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
use App\Answer;
use App\Question;
use App\QuestionGroup;


class QuestionController extends Controller
{
    //
    public function index($questionnaire_id){
        $questionnaire = Questionnaire::where('id', $questionnaire_id)->firstOrFail();
        $questions = Question::where('questionnaire_id', $questionnaire_id)->get();
        return view('backend.questions.index', compact(['questionnaire', 'questions']));
    }

    public function show(Questionnaire $questionnaire, $id){

        $question = Question::where('id', $id)->firstOrFail();
        $answers = Answer::where('question_id', $id)->get();

        return view('backend.questions.show', compact(['question', 'answers', 'questionnaire']));
    }


    public function edit(Questionnaire $questionnaire, $id){
        
        $question = Question::where('id', $id)->firstOrFail();
        $groups = QuestionGroup::all();
        $question->load('answers')->get();

        return view('backend.questions.edit', compact(['questionnaire', 'question', 'groups' ]));
    }

    public function update(Questionnaire $questionnaire, $id, Request $request){
        
     
         
        $data = $request->validate([
            'vi_title'              =>  'required',
            'en_title'               =>  'required',
            'answers.point.*'        =>  'required',
            'group_question'         =>  'required',
         ]);
        

         /*
         *
         * Update question first
         */

         $data_question = [
            'sort'              =>  0,
            'question_group_id' =>  $request->group_question,
            'type'              =>  $request->answer_type,
            'sort'   =>  0,
            'vi' => [
                'question'   =>  $request->vi_title
            ],
            'en' => [
                'question'   =>  $request->en_title
            ]
        ];

        $question = Question::where('id', $id)->firstOrFail();
        $question->update($data_question);
         
        /*
        *
        * Update answer
        *  
        */

        $answers = Answer::where('question_id', $id)->get();

        switch($request->answer_type){
            case 'yn':

                $data_answer_yn = [
                    [   'show_textarea' =>  isset($request->answers['show_form']['yes']) ? 1 : 0,
                        'key'           =>  'yes',
                        'point' =>  $request->answers['point']['yes'],
                        'vi'    =>  [
                            'answer'    =>  'Có',
                        ],
                        'en'    =>  [
                            'answer'    =>  'yes',
                        ],
                    ],
                    [
                        'show_textarea' =>  isset($request->answers['show_form']['no']) ? 1 : 0,
                        'key'           =>  'no',
                        'point' =>  $request->answers['point']['no'],
                        
                        'vi'    =>  [
                                'answer'    =>  'Không',
                        ],
                        'en'    =>  [
                                'answer'    =>  'no'
                        ] 
                    ]
                ];
               
               
                for($i = 0; $i < count($answers); $i++){
                    $answers[$i]->update($data_answer_yn[$i]);
                }

                $request->session()->flash('success', 'Update question success');
                return redirect()->route('manage.questions.index', $questionnaire->id);

            break;
            case 'choice':
                $data_answer_choice = [
                    [   
                        'show_textarea' =>  isset($request->answers[0]['show_form']) ? 1 : 0,
                        'key' =>  'answer_1',
                        'point' =>  $request->answers[0]['point'],
                        'vi'    =>  [
                            'answer'    =>  $request->answers[0]['answer']['vi'],
                        ],
                        'en'    =>  [
                            'answer'    =>  $request->answers[0]['answer']['en'],
                        ],
                    ],
                    [
                        'show_textarea' =>  isset($request->answers[1]['show_form']) ? 1 : 0,
                        'key' =>  'answer_2',
                        'point' =>  $request->answers[1]['point'],
                        'vi'    =>  [
                            'answer'    =>  $request->answers[1]['answer']['vi'],
                        ],
                        'en'    =>  [
                            'answer'    =>  $request->answers[1]['answer']['en'],
                        ],
                    ],
                    [
                        'show_textarea' =>  isset($request->answers[2]['show_form']) ? 1 : 0,
                        'key' =>  'answer_3',
                        'point' =>  $request->answers[2]['point'],
                        'vi'    =>  [
                            'answer'    =>  $request->answers[2]['answer']['vi'],
                        ],
                        'en'    =>  [
                            'answer'    =>  $request->answers[2]['answer']['en'],
                        ],
                    ],
                   
                ];
                for($i = 0; $i < count($answers); $i++){
                    $answers[$i]->update($data_answer_choice[$i]);
                }

           
              
                $request->session()->flash('success', 'Update question success');
                return redirect()->route('manage.questions.index', $questionnaire->id);

            default:
                return redirect()->back();
            break;

       }

    }


    /*
    *
    * Create new question
    */
    public function create($questionnaire_id){
        $questionnaire = Questionnaire::where('id', $questionnaire_id)->firstOrFail();
        $groups = QuestionGroup::all();
        return view('backend.questions.create', compact(['questionnaire', 'groups']));
    }

    public function store(Request $request, $questionnaire_id){
       
        $questionnaire = Questionnaire::where('id', $questionnaire_id)->firstOrFail();
        
        $data = $request->validate([
           'vi_title'               =>  'required',
           'en_title'               =>  'required',
           'answers.point.*'        =>  'required',
           'group_question'         =>  'required',
        ]);

       //create question first
        $data_question = [
            'sort'              =>  0,
            'question_group_id' =>  $request->group_question,
            'questionnaire_id'  =>  $questionnaire_id,
            'type'              =>  $request->answer_type,
            'vi' => [
                'question'   =>  $request->vi_title
            ],
            'en' => [
                'question'   =>  $request->en_title
            ]
        ];
        $question = Question::create($data_question);

        //create answer
    
        switch($request->answer_type){
            case 'yn':

                $data_answer_yn = [
                    [   'show_textarea' =>  isset($request->answers['show_form']['yes']) ? 1 : 0,
                        'key'           =>  'yes',
                        'point' =>  $request->answers['point']['yes'],
                        'vi'    =>  [
                            'answer'    =>  'Có',
                        ],
                        'en'    =>  [
                            'answer'    =>  'yes',
                        ],
                    ],
                    [
                        'show_textarea' =>  isset($request->answers['show_form']['no']) ? 1 : 0,
                        'key'           =>  'no',
                        'point' =>  $request->answers['point']['no'],
                        
                        'vi'    =>  [
                                'answer'    =>  'Không',
                        ],
                        'en'    =>  [
                                'answer'    =>  'no'
                        ] 
                    ]
                ];
               
            $question->answers()->createMany($data_answer_yn);
            $request->session()->flash('success', 'Add question success');
            return redirect()->route('manage.questions.index', $questionnaire_id);

            break;
            case 'choice':
                $data_answer_choice = [
                    [   
                        'show_textarea' =>  isset($request->answers[0]['show_form']) ? 1 : 0,
                        'key' =>  'answer_1',
                        'point' =>  $request->answers[0]['point'],
                        'vi'    =>  [
                            'answer'    =>  $request->answers[0]['answer']['vi'],
                        ],
                        'en'    =>  [
                            'answer'    =>  $request->answers[0]['answer']['en'],
                        ],
                    ],
                    [
                        'show_textarea' =>  isset($request->answers[1]['show_form']) ? 1 : 0,
                        'key' =>  'answer_2',
                        'point' =>  $request->answers[1]['point'],
                        'vi'    =>  [
                            'answer'    =>  $request->answers[1]['answer']['vi'],
                        ],
                        'en'    =>  [
                            'answer'    =>  $request->answers[1]['answer']['en'],
                        ],
                    ],
                    [
                        'show_textarea' =>  isset($request->answers[2]['show_form']) ? 1 : 0,
                        'key' =>  'answer_3',
                        'point' =>  $request->answers[2]['point'],
                        'vi'    =>  [
                            'answer'    =>  $request->answers[2]['answer']['vi'],
                        ],
                        'en'    =>  [
                            'answer'    =>  $request->answers[2]['answer']['en'],
                        ],
                    ],
                   
                ];
                
                $question->answers()->createMany($data_answer_choice);
              
                $request->session()->flash('success', 'Add question success');
                return redirect()->route('manage.questions.index', $questionnaire_id);

            default:
                return redirect()->back();
            break;

       }

    }
}
