<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAPITest extends TestCase {

  /**
   * Testing API to: Get most selled products by date
   * Target: Check if the api returns Bad Request (400 code) if the user dont send the date query param.
   *
   * @return void
   */
  public function testApiMostSelledRouteStatusNoDate() {
    $response = $this->get("api/most-selled-products");
    $response->assertStatus(400);
  }

  /**
   * Testing API to: Get most selled products by date
   * Target: Check if the api returns success response (200 code) if the user send the date query param.
   *
   * @return void
   */
  public function testApiMostSelledRouteStatusWithDate() {
    $response = $this->call("GET", "api/most-selled-products", ["date" => "1977-10-01"]);
    $response->assertStatus(200);
  }

  /**
   * Testing API to: Get most selled products by date
   * Target: Check data format (JSON).
   *
   * @return void
   */
  public function testApiMostSelledFormat() {
    $response = $this->call("GET", "api/most-selled-products", ["date" => "1977-10-01"]);
    // If the API returns data validate complete structure
    if (count($response->json()) > 0) {
      $response->assertJsonStructure([
        [
          'id',
          'name',
          'quantity'
        ]
      ]);
    } else {
      // If the API not returns data validate empty structure.
      $this->assertJsonStructure([]);
    }
  }

}
