<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Provider;
use App\Order;

class DatabaseSeeder extends Seeder {
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
    // Default values
    $def_records_to_inser = 25;

    // Store the content of records to avoid multiple queries to the database.
    $products_count = Product::count();
    $providers_count = Provider::count();
    $orders_count = Order::count();

    // Pivot tables names
    $pivot_prod_provid_tbl = 'products_providers';
    $pivot_prod_orders_tbl = 'products_orders';

    // Filling Products table.
    if ($this->emptyRecords($products_count)) {
      factory(Product::class, $def_records_to_inser)->create();
    }

    // Filling Providers table.
    if ($this->emptyRecords($providers_count)) {
      factory(Provider::class, $def_records_to_inser)->create();
    }

    // Filling Orders table.
    if ($this->emptyRecords($orders_count)) {
      factory(Order::class, $def_records_to_inser)->create();
    }

    // Filling pivot tables if in the database are store records to products and providers model, and the pivot table is empty.
    if (!$this->emptyRecords($products_count) && !$this->emptyRecords($providers_count) &&
        $this->emptyRecords(DB::table($pivot_prod_provid_tbl)->get()->count())) {
      $products_collection = Product::all();
      $providers_collection = Provider::all();
      for ($i = 0; $i <= $def_records_to_inser; $i++) {
        // Adding providers tho random product.
        $products_collection->random()->providers()->attach($providers_collection->random());
      }
    }

    // Filling pivot tables if in the database are store records to products and orders model, and the pivot table is empty.
    if (!$this->emptyRecords($products_count) && !$this->emptyRecords($orders_count) &&
        $this->emptyRecords(DB::table($pivot_prod_orders_tbl)->get()->count())) {
      $products_collection = Product::all();
      $orders_collection = Order::all();
      for ($i = 0; $i <= $def_records_to_inser; $i++) {
        // Adding orders tho random product.
        $products_collection->random()->orders()->attach($orders_collection->random());
      }
    }
  }

  private function emptyRecords($count) {
    return $count <= 0;
  }
}
