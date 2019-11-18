<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

  // Define the relation between Product and Inventary model, whit a belongs to many relation.
  public function product() {
    return $this->belongsTo('App\Product');
  }

}