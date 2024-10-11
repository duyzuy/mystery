<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class questionsFilterView implements FromView
{
    public $view;
    public $questionnaireName;
    public $questions;
    public $region;
    public $brand;
    public $restaurant;
    public $dateFrom;
    public $dateTo;
    public $answerType;



    public function __construct($view, $questionnaireName = "", $questions = "", $region = "", $brand = '', $restaurant = '', $dateFrom = "", $dateTo = "", $answerType = "")
    {
        $this->view = $view;
        $this->questionnaireName = $questionnaireName;
        $this->questions = $questions;
        $this->region = $region;
        $this->brand = $brand;
        $this->restaurant = $restaurant;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->answerType = $answerType;
    }

    public function view(): View
    {
      
        return view($this->view, [
                'questionnaireName' => $this->questionnaireName, 
                'questions' => $this->questions, 
                'region' => $this->region, 
                'brand' => $this->brand, 
                'restaurant' => $this->restaurant, 
                'dateFrom' => $this->dateFrom, 
                'dateTo' => $this->dateTo, 
                'answerType' => $this->answerType, 
              
            ]
        );
    }
}
