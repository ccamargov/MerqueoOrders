<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model {

  // Define the relation between Carrier and Order model, whit a Has and belongs to many relation.
  public function orders() {
    return $this->belongsToMany('App\Order', 'carriers_orders');
  }

}