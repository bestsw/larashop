<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Category;
use App\Product;

class MainCtrl extends Controller {

   var $brands;
   var $categories;
   var $products;
   var $title;
   var $description;

   public function __construct() {
      $this->brands = Brand::all(array('name'));
      $this->categories = Category::all(array('name'));
      $this->products = Product::all(array('id', 'name', 'price'));
   }
   
   public function index() {
       return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }
    
   public function contact_us() {
      return view('contact_us', array('title' => 'Welcome','description' => '','page' => 'contact_us'));
   }

   public function search($query) {
      return view('products', array('title' => 'Welcome','description' => '','page' => 'products'));
   }
}
