<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'type'=>'admin'
        ]);
        DB::table('roles')->insert([
            'type'=>'employee'
        ]);
        DB::table('roles')->insert([
            'type'=>'vendor'
        ]);
    }
}
