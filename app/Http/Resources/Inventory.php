<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Inventory extends JsonResource {
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request) {
    return [
      'id' => $this->id,
      'quantity' => $this->quantity,
      'availableDate' => $this->availableDate,
      // Validating field - Defensive development
      'product' => $this->product != null ? [
        'id' => $this->product->id,
        'name' => $this->product->name,
      ] : null,
      'updated_at' => $this->updated_at,
      'created_at' => $this->created_at,
    ];
  }
}