<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarrierAPITest extends TestCase {

  /**
   * Testing API to: Check which carriers-orders and how much can be listed from the inventory.
   * Target: Check if the new route is available.
   *
   * @return void
   */
  public function testApiRouteStatus() {
    $response = $this->get("api/carriers-orders");
    $response->assertStatus(200);
  }

  /**
   * Testing API to: Check which carriers-orders and how much can be listed from the inventory.
   * Target: Check data format (JSON)
   *
   * @return void
   */
  public function testApiFormat() {
    $response = $this->get("api/carriers-orders");
    $response->assertJsonStructure([
      'data' => [
        [
          'id',
          'names',
          'orders',
          'created_at',
          'updated_at'
        ]
      ]
    ]);
  }

}
