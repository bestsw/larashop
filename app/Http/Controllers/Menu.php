<?php

namespace App\Http\Controllers;
use View;
use DB;
class Menu extends Controller {

    public function __construct() {
      $sql = 'SELECT id_menu, menu_name, menu_link FROM lrs_menu';
      $rsl = DB::select($sql);
      View::share('lrs_menu', $rsl);
      return $rsl;
    }
}
