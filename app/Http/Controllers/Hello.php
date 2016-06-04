<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class Hello extends Controller {

//   public function index() {
//      return 'hello world from controller : )';
//   }

   public function index($name, $id, $fname) {
      return view('hello', array('name' => $name, 'id' => $id, 'fname' => $fname));
   }

}
