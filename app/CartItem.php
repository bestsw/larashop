<?php

namespace App;

class CartItem extends BaseModel {
   protected $primaryKey = 'id';
   protected $table = 'cart_items';
   protected $fillable = array('cart_id', 'product_id');
}
