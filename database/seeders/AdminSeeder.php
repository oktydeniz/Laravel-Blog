<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
          'name'=>'Oktay Deniz',
          'email'=>'oktay_deniz077@hotmail.com',
          'password'=>bcrypt(102030),
        ]);

    }
}
