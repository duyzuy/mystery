<?php

namespace App\Exports;

use App\User;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
   
    use Exportable;

    public $type;

    public function __construct($type = 'all'){

        $this->type = $type;

    }
    public function query(){

        if($this->type == 'actived'){

            return User::where('actived', 1);

        }elseif($this->type == 'unactive'){

            return User::where('actived', 0);

        }else{

            return User::query();

        }
       
    }


    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone_number,
            $user->store->translate('en')->store_name,
            $user->bank_name,
            $user->bank_number,
            $user->bank_address,
            ($user->actived == 1) ? 'active' : 'un-active',
            date('M j, Y h:ia', strtotime($user->created_at)),
           
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Phone',
            'Address',
            'Store name',
            'Bank name',
            'Card number',
            'Bank address',
            'Status',
            'Register date'
        ];
    }
}
