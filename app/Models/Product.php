<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

  // Define the relation between Product and Order model, whit a Has and belongs to many relation.
  public function orders() {
    return $this->belongsToMany('App\Order', 'products_orders');
  }

  // Define the relation between Product and Provider model, whit a Has and belongs to many relation.
  public function providers() {
    return $this->belongsToMany('App\Provider', 'products_providers');
  }

  // Define the relation between Product and Provider model, whit a Has and belongs to many relation.
  public function inventories() {
    return $this->hasMany('App\Inventory');
  }
}