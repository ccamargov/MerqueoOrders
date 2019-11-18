<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOrdersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('products_orders', function (Blueprint $table) {
      // Basic schema defintion
      $table->bigInteger('product_id')->unsigned();
      $table->bigInteger('order_id')->unsigned();
    });

    Schema::table('products_orders', function($table) {
      // References - Foreign keys
      $table->foreign('product_id')->references('id')->on('products');
      $table->foreign('order_id')->references('id')->on('orders');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('products_orders');
  }
}
