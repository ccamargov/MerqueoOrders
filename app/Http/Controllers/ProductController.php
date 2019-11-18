<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller {

  /**
   * Display a listing products available in products inventory table.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    // Get all records
    $products = Product::all();
    // Return a list of products in inventory as a resource
    return ProductResource::collection($products);
  }

}