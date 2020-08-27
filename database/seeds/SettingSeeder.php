<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('regions')->insert([
            [
                'code' => 'N',
            ],
            [
                'code' => 'C',
            ],
            [
                'code' => 'S',
            ]
        ]);
        DB::table('regions_translation')->insert([
            [
                'region_id' => 1,
                'locale' => 'vi',
                'name'  =>  'Miền Bắc' 
            ],
            [
                'region_id' => 1,
                'locale' => 'en',
                'name'  =>  'Northern' 
            ],
            [
                'region_id' => 2,
                'locale' => 'vi',
                'name'  =>  'Miền Trung' 
            ],
            [
                'region_id' => 2,
                'locale' => 'en',
                'name'  =>  'Central' 
            ],
            [
                'region_id' => 3,
                'locale' => 'vi',
                'name'  =>  'Miền Nam' 
            ],
            [
                'region_id' => 3,
                'locale' => 'en',
                'name'  =>  'South' 
            ],
        ]);
        DB::table('settings')->insert([
            [   
                'setting_name' => 'section_1',

            ],
            [
                'setting_name' => 'footer',

            ],
        ]);
        DB::table('setting_translation')->insert([
            [   
                'setting_id' =>     1,
                'locale'    =>      'vi',
                'setting_value' =>  null,

            ],
            [   
                'setting_id' =>     1,
                'locale'    =>      'en',
                'setting_value' =>  null,

            ],
            [   
                'setting_id' =>     2,
                'locale'    =>      'vi',
                'setting_value' =>  null,

            ],
            [   
                'setting_id' =>     2,
                'locale'    =>      'en',
                'setting_value' =>  null,

            ],
            
        ]);
     

    }
}
