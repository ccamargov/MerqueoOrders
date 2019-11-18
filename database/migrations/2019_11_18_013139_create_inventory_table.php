<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('inventories', function (Blueprint $table) {
      // Basic schema defintion
      $table->bigIncrements('id');
      $table->integer('quantity');
      $table->date('availableDate')->default("2019-03-01");
      $table->unsignedBigInteger('product_id');
      $table->timestamps();
    });

    Schema::table('inventories', function($table) {
      // References - Foreign keys
      $table->foreign('product_id')->references('id')->on('products');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('inventories');
  }
}
