<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = ['Eğlence', 'Bilişim', 'Gezi', 'Teknoloji', 'Sağlık', 'Spor', 'Günlük Yaşam', 'Genel'];

    foreach ($categories as $key) {
      DB::table('categories')->insert([
        'name' => $key,
        'slug' => Str::slug($key),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
