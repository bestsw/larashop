<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Brand;
use App\Category;
use App\Product;

class ProductCtrl extends Controller {

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

   public function products() {
      return view('products', array('title' => 'Products Listing', 'description' => '', 'page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }

   public function product_details($id) {
      $product = Product::find($id);
      return view('product_details', array('product' => $product, 'title' => $product->name, 'description' => '', 'page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }

   public function product_categories($name) {
      return view('products', array('title' => 'Welcome', 'description' => '', 'page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }

   public function product_brands($name, $category = null) {
      return view('products', array('title' => 'Welcome', 'description' => '', 'page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
   }

}
