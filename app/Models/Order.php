<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  // Define the relation between Product and Order model, whit a Has and belongs to many relation.
  public function products() {
    // Define pivot colum to get the amount of items for product
    return $this->belongsToMany('App\Product', 'products_orders')->withPivot(["quantity"]);
  }

  // Define the relation between Carrier and Order model, whit a Has and belongs to many relation.
  public function carriers() {
    return $this->belongsToMany('App\Carrier', 'carriers_orders');
  }

}