<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class topRestaurantView implements FromView
{
    public $view;
    public $restaurants;
    public $answerType;
    public $dateFrom;
    public $dateTo;
    
    
  
    public function __construct($view, $restaurants = "", $answerType = "", $dateFrom = "", $dateTo = "")
    {
        $this->view = $view;
        $this->restaurants = $restaurants;
        $this->answerType = $answerType;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
       
    }

    public function view(): View
    {
      
        return view($this->view, [
                'restaurants' => $this->restaurants, 
                'answerType' => $this->answerType,
                'dateFrom' => $this->dateFrom,
                'dateTo' => $this->dateTo,
                
            ]
        );
    }
}
