<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {

  /**
   * Display a listing of most products sold in a order, by date.
   * Uses order pattern to define the list.
   * 
   * @return \Illuminate\Http\Response
   */
  public function getMostSelledProducts(Request $request) {
    return $this->getOrderedProductsSoldByDate($request, "DESC");
  }

  /**
   * Display a listing of less products sold in a order, by date.
   * Uses order pattern to define the list.
   *
   * @return \Illuminate\Http\Response
   */
  public function getLessSelledProducts(Request $request) {
    return $this->getOrderedProductsSoldByDate($request, "ASC");
  }

  /**
   * Display a listing of products by order, with their respective availability.
   * Uses operator pattern to define the list.
   *
   * @return \Illuminate\Http\Response
   */
  public function getProductsAvailability(Request $request) {
    // Validate request
    $validator = Validator::make($request->all(), [
      'order_id' => 'required'
    ]);
    // If validator fails, return json with errors array with 400 (Bad Request)
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }
     // If the validator does not fail then make the model query
    else {
      // Return available products and save records to make advanced JSON Object.
      $products_available = Product::getProductsAvailability($request->get('order_id'), '<=');
      // Return non available products and save records to make advanced JSON Object.
      $products_non_available = Product::getProductsAvailability($request->get('order_id'), '>');
      // Return plain result from model query
      return [
        "available" => $products_available,
        "non-available" => $products_non_available
      ];
    }
  }

  /**
   * Display a listing of products updated in inventary, between two dates (Checking in inventary an orders table).
   *
   * @return \Illuminate\Http\Response
   */
  public function getInventaryAfterSales(Request $request) {
    // Validate request
    $validator = Validator::make($request->all(), [
      'date_sales' => 'required',
      'date_revision' => 'required'
    ]);
    // If validator fails, return json with errors array with 400 (Bad Request)
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }
     // If the validator does not fail then make the model query
    else {
      $products = Product::getInventaryAfterSales($request->get('date_sales'), $request->get('date_revision'));
      return $products;
    }
  }

  /**
   * Shared function that returns listing of products sold in a order, by date.
   * Uses order pattern to define the list.
   *
   * @return \Illuminate\Http\Response
   */
  private function getOrderedProductsSoldByDate(Request $request, $order) {
    // Validate request
    $validator = Validator::make($request->all(), [
      'date' => 'required'
    ]);
    // If validator fails, return json with errors array with 400 (Bad Request)
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 400);
    }
     // If the validator does not fail then make the model query
    else {
      $products = Product::getOrderedSelledProductsByDate($request->get('date'), $order);
      // Return plain result from model query
      return $products;
    }
  }

}