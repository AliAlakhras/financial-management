<?php

use Illuminate\Database\Seeder;

class RoleCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_roles')->insert([
            'type'=>'admin'
        ]);
        DB::table('company_roles')->insert([
            'type'=>'employee'
        ]);
    }
}
