<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'admin',
            'password'=>Hash::make('123123123'),
            'role_id'=>'1',
            'email'=>'admin@gmail.com',
        ]);
    }
}
