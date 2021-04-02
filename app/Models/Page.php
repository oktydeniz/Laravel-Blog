<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $table = 'pages';
  protected $guarded = ['id'];
  public $timestamps = true;
  protected $fillable = ['title','image','content','slug','order'];

}
