<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAPITest extends TestCase {

  /**
   * Testing API to: Get most products sold by date
   * Target: Check if the api returns Bad Request (400 code) if the user dont send the date query param.
   *
   * @return void
   */
  public function testApiMostSoldRouteStatusNoDate() {
    $response = $this->get("api/most-products-sold");
    $response->assertStatus(400);
  }

  /**
   * Testing API to: Get most products sold by date
   * Target: Check if the api returns success response (200 code) if the user send the date query param.
   *
   * @return void
   */
  public function testApiMostSoldRouteStatusWithDate() {
    $response = $this->call("GET", "api/most-products-sold", ["date" => "1977-10-01"]);
    $response->assertStatus(200);
  }

  /**
   * Testing API to: Get most products sold by date
   * Target: Check data format (JSON).
   *
   * @return void
   */
  public function testApiMostSoldFormat() {
    $response = $this->call("GET", "api/most-products-sold", ["date" => "1977-10-01"]);
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

  /**
   * Testing API to: Get less products sold by date
   * Target: Check if the api returns Bad Request (400 code) if the user dont send the date query param.
   *
   * @return void
   */
  public function testApiLessSoldRouteStatusNoDate() {
    $response = $this->get("api/less-products-sold");
    $response->assertStatus(400);
  }

  /**
   * Testing API to: Get less products sold by date
   * Target: Check if the api returns success response (200 code) if the user send the date query param.
   *
   * @return void
   */
  public function testApiLessSoldRouteStatusWithDate() {
    $response = $this->call("GET", "api/less-products-sold", ["date" => "1977-10-01"]);
    $response->assertStatus(200);
  }

  /**
   * Testing API to: Get less products sold by date
   * Target: Check data format (JSON).
   *
   * @return void
   */
  public function testApiLessSoldFormat() {
    $response = $this->call("GET", "api/less-products-sold", ["date" => "1977-10-01"]);
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

  /**
   * Testing API to: Get the list of products by order, with their respective availability.
   * Target: Check if the api returns Bad Request (400 code) if the user dont send the order_id query param.
   *
   * @return void
   */
  public function testApiProdAvailabilityRouteStatusNoOrder() {
    $response = $this->get("api/products-availability");
    $response->assertStatus(400);
  }

  /**
   * Testing API to: Get the list of products by order, with their respective availability.
   * Target: Check if the api returns Bad Request (400 code) if the user send the order_id query param.
   *
   * @return void
   */
  public function testApiProdAvailabilityRouteStatusWithOrder() {
    $response = $this->call("GET", "api/products-availability", ["order_id" => 2]);
    $response->assertStatus(200);
  }

}
