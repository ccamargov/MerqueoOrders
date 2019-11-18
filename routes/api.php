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

// Define route of API to: Check which products and how much can be listed from the inventory.
Route::get('inventory', 'InventoryController@index')->name('inventory.index');
// Define route of API to: Consult the products that must be listed by transporters, and to which transporter each order corresponds.
Route::get('carriers-orders', 'CarrierController@index')->name('carriers.index');
