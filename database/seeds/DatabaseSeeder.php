<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Provider;
use App\Order;
use App\Inventory;
use App\Carrier;

class DatabaseSeeder extends Seeder {
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run() {
    // Default values
    $def_records_to_inser = 25;

    // Pivot tables names
    $pivot_prod_provid_tbl = 'products_providers';
    $pivot_prod_orders_tbl = 'products_orders';
    $pivot_carriers_orders_tbl = 'carriers_orders';

    // Filling Products table.
    if ($this->emptyRecords(Product::count())) {
      echo "Inserting dummy data for Product model...\n";
      factory(Product::class, $def_records_to_inser)->create();
    }

    // Filling Providers table.
    if ($this->emptyRecords(Provider::count())) {
      echo "Inserting dummy data for Provider model...\n";
      factory(Provider::class, $def_records_to_inser)->create();
    }

    // Filling Orders table.
    if ($this->emptyRecords(Order::count())) {
      echo "Inserting dummy data for Order model...\n";
      factory(Order::class, $def_records_to_inser)->create();
    }

    // Filling pivot tables if in the database are store records to products and providers model, and the pivot table is empty.
    if (!$this->emptyRecords(Product::count()) && !$this->emptyRecords(Provider::count()) &&
        $this->emptyRecords(DB::table($pivot_prod_provid_tbl)->get()->count())) {
      $products_collection = Product::all();
      $providers_collection = Provider::all();
      echo "Inserting dummy data for ProductProviders pivot model...\n";
      for ($i = 0; $i <= $def_records_to_inser; $i++) {
        // Adding providers tho random product.
        $products_collection->random()->providers()->attach($providers_collection->random());
      }
    }

    // Filling pivot tables if in the database are store records to products and orders model, and the pivot table is empty.
    if (!$this->emptyRecords(Product::count()) && !$this->emptyRecords(Order::count()) &&
        $this->emptyRecords(DB::table($pivot_prod_orders_tbl)->get()->count())) {
      $products_collection = Product::all();
      $orders_collection = Order::all();
      echo "Inserting dummy data for ProductOrders pivot model...\n";
      for ($i = 0; $i <= $def_records_to_inser; $i++) {
        // Adding orders tho random product.
        $products_collection->random()->orders()->attach($orders_collection->random());
      }
    }

    // Filling Inventories table.
    if (!$this->emptyRecords(Product::count()) && $this->emptyRecords(Inventory::count())) {
      echo "Inserting dummy data for Inventory model...\n";
      factory(Inventory::class, $def_records_to_inser)->create();
    }

    // Filling Carriers table.
    if ($this->emptyRecords(Carrier::count())) {
      echo "Inserting dummy data for Carrier model...\n";
      factory(Carrier::class, $def_records_to_inser)->create();
    }

    // Filling pivot tables if in the database are store records to carriers and orders model, and the pivot table is empty.
    if (!$this->emptyRecords(Carrier::count()) && !$this->emptyRecords(Order::count()) &&
        $this->emptyRecords(DB::table($pivot_carriers_orders_tbl)->get()->count())) {
      $carriers_collection = Carrier::all();
      $orders_collection = Order::all();
      echo "Inserting dummy data for CarriersOrders pivot model...\n";
      for ($i = 0; $i <= $def_records_to_inser; $i++) {
        // Adding orders tho random carrier.
        $carriers_collection->random()->orders()->attach($orders_collection->random());
      }
    }
  }

  private function emptyRecords($count) {
    return $count <= 0;
  }
}
