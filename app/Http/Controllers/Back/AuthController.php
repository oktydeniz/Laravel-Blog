<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function LogIn(){
    return view('back.auth.login');
  }


  public function LogInPost(Request $req){
  //  dd($req->post());
      if(Auth::attempt(['email'=>$req->email,'password'=>$req->password])){
        toastr()->success('Hoşgeldiniz ! '.Auth::user()->name);
      return redirect()->route('admin.home');
    }else{
      return redirect()->route('admin.login')->withErrors('Email Adresi veya Şifre Hatalı !');
    }
  }

  public function LogOut(){
    Auth::logout();
    return redirect()->route('admin.login');
  }
}
