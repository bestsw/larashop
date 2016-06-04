<?php

namespace App;

class Cart extends BaseModel {
   protected $primaryKey = 'id';
   protected $table = 'carts';
   protected $fillable = array('user_id', 'product_id');
}
