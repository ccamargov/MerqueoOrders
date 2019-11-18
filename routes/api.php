<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Encapsulate APIs to validate access whit api_key from users table.
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
  // Define route of API to: Check which products and how much can be listed from the inventory.
  Route::get('inventory', 'InventoryController@index')->name('inventory.index');
  // Define route of API to: Consult the products that must be listed by transporters, and to which transporter each order corresponds.
  Route::get('carriers-orders', 'CarrierController@index')->name('carriers.index');
  // Define route of API to: Consult the most products sold by date
  Route::get('most-products-sold', 'ProductController@getMostSelledProducts')->name('products.most-products-sold');
  // Define route of API to: Consult the less products sold by date
  Route::get('less-products-sold', 'ProductController@getLessSelledProducts')->name('products.less-products-sold');
  // Define route of API to: Consult the list of products by order, with their respective availability.
  Route::get('products-availability', 'ProductController@getProductsAvailability')->name('products.products-availability');
  // Define route of API to: Consult the list of products in inventary, with the amount of items updated, between two dates.
  Route::get('inventory-updated', 'ProductController@getInventaryAfterSales')->name('products.inventory-updated');
});

