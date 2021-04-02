<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $table = 'contacts';
  protected $guarded = ['id'];
  public $timestamps = true;
  protected $fillable = ['name','email','topic','message'];
}
