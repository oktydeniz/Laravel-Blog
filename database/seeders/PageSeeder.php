<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=PageSeeder
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda','Kariyer','Vizyon','Misyon',];
        $count=0;
        foreach ($pages as $key) {
          $count++;
          DB::table('pages')->insert([
            'title'=>$key,
            'slug'=>$key,
            'image'=>'https://www.google.com/url?sa=i&url=https%3A%2F%2Findustrytoday.com%2Fservices-every-business-should-consider%2F&psig=AOvVaw3nUgQgjc43K9v8bqpT19YS&ust=1612631014047000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCLjxk-ic0-4CFQAAAAAdAAAAABAO',
            'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'order'=>$count,
            'created_at'=>now(),
            'updated_at'=>now(),
          ]);
        }
    }
}
