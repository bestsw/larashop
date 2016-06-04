<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Cart;
use App\CartItem;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class Front extends Controller {

    var $brands;
    var $categories;
    var $products;
    var $title;
    var $description;

    public function __construct() {
         
        $this->brands = Brand::all(array('name'));
        $this->categories = Category::all(array('name'));
        $this->products = Product::all(array('id','name','price'));
    }

    public function index() {
        return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function products() {
        return view('products', array('title' => 'Products Listing','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_details($id) {
        $product = Product::find($id);
        return view('product_details', array('product' => $product, 'title' => $product->name,'description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_categories($name) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_brands($name, $category = null) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog() {
        return view('blog', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog_post($id) {
        return view('blog_post', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function contact_us() {
        return view('contact_us', array('title' => 'Welcome','description' => '','page' => 'contact_us'));
    }

    public function login() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function logout() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function cart() {
      //update/ add new item to cart
      if (Request::isMethod('post')) {
          $product_id = Request::get('product_id');
          $product = Product::find($product_id);
           Cart::create(array('user_id' => 1, 'product_id' => $product_id));
//          Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
      }

      //increment the quantity
      if (Request::get('product_id') && (Request::get('increment')) == 1) {
          $product_id = Request::get('product_id');
          $product = Product::find($product_id);
           Cart::create(array('user_id' => 1, 'product_id' => $product_id));
      }

      //decrease the quantity
      if (Request::get('product_id') && (Request::get('decrease')) == 1) {
         $results = DB::select('select id from carts where product_id = :id order by id desc limit 1', ['id' => Request::get('product_id')]);
         $remove_cart = Cart::find($results[0]->id);
         $remove_cart->delete();
      }

//      $cart = Cart::content();
      $rsl = DB::select('select p.id, count(1) as qty, sum(p.price) as subtotal, p.name, p.price from carts as c join products as p on(c.product_id=p.id) group by p.id');
      $cart = array();
      $total = 0;
      if($rsl){
         foreach($rsl as $v){
            $cart[$v->id] = $v;
            $total += $v->subtotal;
         }
      }
      return view('cart', array('cart' => $cart, 'total' => $total, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
  }


    public function checkout() {
        return view('checkout', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function search($query) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products'));
    }
    public function fw_print_r($array) {
       echo '<pre>';
       print_r($array);
       echo '</pre>';
    }
}
