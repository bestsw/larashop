<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use DB;

class CartCtrl extends Controller {

   public function cart() {
      if (Request::isMethod('post')) {
         $product_id = Request::get('product_id');
         $product = Product::find($product_id);
         Cart::create(array('user_id' => 1, 'product_id' => $product_id));
      }

      //increment the quantity
      if (Request::get('product_id') && (Request::get('increment')) == 1) {
         $product_id = Request::get('product_id');
         $product = Product::find($product_id);
         Cart::create(array('user_id' => 1, 'product_id' => $product_id));
      }

      //decrease the quantity
      if (Request::get('product_id') && (Request::get('decrease')) == 1) {
         $results = DB::select('SELECT id FROM carts WHERE product_id = :id ORDER BY id DESC LIMIT 1', ['id' => Request::get('product_id')]);
         $remove_cart = Cart::find($results[0]->id);
         $remove_cart->delete();
      }

//      $cart = Cart::content();
      $rsl = DB::select('SELECT p.id, COUNT(1) AS qty, SUM(p.price) AS subtotal, p.name, p.price 
      FROM carts AS c JOIN products AS p ON(c.product_id=p.id) GROUP BY p.id');
      $cart = array();
      $total = 0;
      if ($rsl) {
         foreach ($rsl as $v) {
            $cart[$v->id] = $v;
            $total += $v->subtotal;
         }
      }
      return view('cart', array('cart' => $cart, 'total' => $total, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
   }

   public function checkout() {
      return view('checkout', array('title' => 'Welcome', 'description' => '', 'page' => 'home'));
   }

}
