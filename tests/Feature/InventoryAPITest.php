<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryAPITest extends TestCase {

  /**
   * Testing API to: Check which products and how much can be listed from the inventory.
   * Target: Check if the new route is available.
   *
   * @return void
   */
  public function testApiRouteStatus() {
    $response = $this->call("GET", "api/v1/inventory", ["api_token" => "0g3AubZqweE81ufvZYHYQpmjdk1VzriAlyEgiOpqmBJIerMKzjNNXs4YUsTt"]);
    $response->assertStatus(200);
  }

  /**
   * Testing API to: Check which products and how much can be listed from the inventory.
   * Target: Check data format (JSON)
   *
   * @return void
   */
  public function testApiFormat() {
    $response = $this->call("GET", "api/v1/inventory", ["api_token" => "0g3AubZqweE81ufvZYHYQpmjdk1VzriAlyEgiOpqmBJIerMKzjNNXs4YUsTt"]);
    // If the API returns data validate complete structure
    if (count($response->json()) > 0) {
      $response->assertJsonStructure([
        'data' => [
          [
            'id',
            'quantity',
            'availableDate',
            'product' => [
              'id',
              'name'
            ],
            'created_at',
            'updated_at'
          ]
        ]
      ]);
    } else {
      // If the API not returns data validate empty structure.
      $this->assertJsonStructure([]);
    }
  }

}
