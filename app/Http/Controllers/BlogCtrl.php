<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Category;
use App\Product;

class BlogCtrl extends Controller {

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
   
   public function blog() {
      return view('blog', array('title' => 'Welcome', 'description' => '', 'page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }

   public function blog_post($id) {
      return view('blog_post', array('title' => 'Welcome', 'description' => '', 'page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }

}
