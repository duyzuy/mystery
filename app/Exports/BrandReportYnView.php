<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class BrandReportYnView implements FromView
{
    public $view;
    public $brandReport;
    public $groupQuestions;
    public $dateFrom;
    public $dateTo;

    public function __construct($view, $brandReport = "", $groupQuestions = "", $dateFrom = "", $dateTo = "")
    {
        $this->view = $view;
        $this->brandReport = $brandReport;
        $this->groupQuestions = $groupQuestions;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function view(): View
    {
      

        return view($this->view, [
                'brandReport' => $this->brandReport, 
                'groupQuestions' => $this->groupQuestions,
                'dateFrom'  =>  $this->dateFrom,
                'dateTo' => $this->dateTo, 
            ]
        );
    }
    
}
