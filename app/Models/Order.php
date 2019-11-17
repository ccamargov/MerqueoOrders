<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  // Define the relation between Product and Order model, whit a Has and belongs to many relation.
  public function products() {
    return $this->belongsToMany('App\Product', 'products_orders');
  }

}