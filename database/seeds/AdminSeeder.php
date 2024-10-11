<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'role_name' => 'admin',
                'role_descriptions' => 'This is admin page',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_name' => 'manager',
                'role_descriptions' => 'This is manager',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                
            ]
        ]);

        DB::table('admins')->insert([
            [
                'name' => 'admin',
                'email' => 'guestsurvey@afg.vn',
                'roles_id'  =>  1,
                'password' => Hash::make('guestSV@afg'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'roles_id'  =>  2,
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);

       
    }
}
