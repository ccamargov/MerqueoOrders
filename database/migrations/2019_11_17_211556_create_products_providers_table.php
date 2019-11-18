<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsProvidersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('products_providers', function (Blueprint $table) {
      // Basic schema defintion
      $table->bigInteger('product_id')->unsigned()->nullable();
      $table->bigInteger('provider_id')->unsigned()->nullable();
    });

    Schema::table('products_providers', function($table) {
      // References - Foreign keys
      $table->foreign('product_id')->references('id')->on('products');
      $table->foreign('provider_id')->references('id')->on('providers');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('products_providers');
  }
}
