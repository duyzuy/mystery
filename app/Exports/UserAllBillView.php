<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserAllBillView implements FromView
{

    public $view;
    public $surveys;


    public function __construct($view, $surveys = "")
    {
        $this->view = $view;
        $this->surveys = $surveys;
    }

    public function view(): View
    {

        return view(
            $this->view,
            [
                'surveys' => $this->surveys,
            ]
        );
    }
}
