<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product as ProductResource;

class Order extends JsonResource {
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request) {
    return [
      'id' => $this->id,
      'priority' => $this->priority,
      'address' => $this->address,
      'personName' => $this->personName,
      'deliverDate' => $this->deliverDate,
      'products' => ProductResource::collection($this->products)
    ];
  }
}