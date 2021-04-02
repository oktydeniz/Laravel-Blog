<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';
  protected $guarded = ['id'];
  public $timestamps = true;
  protected $fillable = ['name', 'slug'];

  public function articleCount()
  {
    return $this->hasMany(Article::class, 'category_id', 'id')->where('status', 1)->count();
  }
}
