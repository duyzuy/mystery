<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResponseExportView implements FromView
{
    public $view;
    public $groupQuestions;
    public $survey;
 

  
    public function __construct($view, $groupQuestions = "", $survey = "")
    {
        $this->view = $view;
        $this->groupQuestions = $groupQuestions;
        $this->survey = $survey;
      
    }

    public function view(): View
    {
      

        return view($this->view, [
                'groupQuestions' => $this->groupQuestions, 
                'survey' => $this->survey,
              
            ]
        );
    }
}
