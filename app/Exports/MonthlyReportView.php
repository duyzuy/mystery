<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyReportView implements FromView
{
    public $view;
    public $brandWithSurveys;
    public $groupQuestions;
    public $answerType;
    public $region;
    public $brand;
    public $restaurant;
    public $dFrom;
    public $dTo;

  
    public function __construct($view, $brandWithSurveys = "", $groupQuestions = "", $answerType = "", $region = "", $brand = "", $restaurant = "", $dFrom = "", $dTo = "")
    {
        $this->view = $view;
        $this->brandWithSurveys = $brandWithSurveys;
        $this->groupQuestions = $groupQuestions;
        $this->answerType = $answerType;
        $this->region = $region;
        $this->brand = $brand;
        $this->restaurant = $restaurant;
        $this->dFrom = $dFrom;
        $this->dTo = $dTo;
    }

    public function view(): View
    {
      
        return view($this->view, [
                'brandWithSurveys' => $this->brandWithSurveys, 
                'groupQuestions' => $this->groupQuestions,
                'answerType' => $this->answerType, 
                'region' => $this->region,
                'brand' => $this->brand,
                'restaurant' => $this->restaurant,
                'dFrom' => $this->dFrom,
                'dTo' => $this->dTo,
            ]
        );
    }
}
