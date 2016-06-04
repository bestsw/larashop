<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthLoginCtrl extends Controller
{
   public function LoginSetting() {
      return view('auth.login_setting');
   }
   
   public function HandleLoginSetting() {
      
   }
}
