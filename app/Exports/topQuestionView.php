<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class topQuestionView implements FromView
{
    public $view;
    public $questions;
    public $filter;
    


    public function __construct($view, $questions = "", $filter = "")
    {
        $this->view = $view;
        $this->questions = $questions;
        $this->filter = $filter;
    }

    public function view(): View
    {
      
        return view($this->view, [
                'questions' => $this->questions, 
                'filter' => $this->filter, 
              
            ]
        );
    }
}
