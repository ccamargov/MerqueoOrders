<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('orders', function (Blueprint $table) {
      // Basic schema defintion
      $table->bigIncrements('id');
      /* priority field can be modified by the data type "enum", but to facilitate the development
       * it is defined as an integer and at the backend level the allowed options are limited.
      */
      $table->smallInteger('priority');
      $table->string('address', 60);
      $table->string('personName', 60);
      $table->date('deliverDate');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('orders');
  }
}
