<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {

  /**
   * Display a listing of most selled products in a order, by date.
   *
   * @return \Illuminate\Http\Response
   */
  public function getMostSelledProducts(Request $request) {
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
      $products = Product::getMostSelledProductsByDate($request->get('date'));
      // Return plain result from model query
      return $products;
    }
  }

}