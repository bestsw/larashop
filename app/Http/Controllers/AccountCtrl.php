<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AccountCtrl extends Controller {

   public function login() {
      return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
   }

   public function logout() {
      return view('login', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
   }

}
