<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{

  use SoftDeletes;
  protected $table = 'atricles';
  protected $guarded = ['id'];
  public $timestamps = true;
  protected $fillable = ['category_id', 'title', 'image', 'content', 'hit', 'slug'];

  public function getCategoryName()
  {
    return $this->hasOne(Category::class, 'id', 'category_id');
    //Bağlanacağımız model  // bağlanacağımız sütun //bağlanacak sütun
  }

}
