<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Product;
use App\Provider;
use App\Order;

class DatabaseTest extends TestCase {

  /**
   * Check that all ORMs are correctly configured.
   *
   * @return void
   */
  public function testORMs() {
    $this->assertTrue(Product::all() != null);
    $this->assertTrue(Provider::all() != null);
    $this->assertTrue(Order::all() != null);
  }

}
