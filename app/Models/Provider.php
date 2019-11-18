<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model {

  // Define the relation between Product and Provider model, whit a Has and belongs to many relation.
  public function products() {
    return $this->belongsToMany('App\Product', 'products_providers');
  }

}