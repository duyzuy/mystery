<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class userBillFilterView implements FromView
{
    public $view;
    public $surveys;
    public $region;
    public $brand;
    public $restaurant;
    public $dateFrom;
    public $dateTo;


    public function __construct($view, $surveys = "", $region = "", $brand = "", $restaurant = "", $dateFrom = "", $dateTo = "")
    {
        $this->view = $view;
        $this->surveys = $surveys;
        $this->region = $region;
        $this->brand = $brand;
        $this->restaurant = $restaurant;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function view(): View
    {
      
        return view($this->view, [
                'surveys' => $this->surveys, 
                'region' => $this->region, 
                'brand' => $this->brand, 
                'restaurant' => $this->restaurant, 
                'dateFrom' => $this->dateFrom, 
                'dateTo' => $this->dateTo, 
              
            ]
        );
    }
}
