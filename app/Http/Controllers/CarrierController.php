<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Carrier;
use App\Http\Resources\Carrier as CarrierResource;

class CarrierController extends Controller {

  /**
   * Display a listing inventories available in inventories Carriers table.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    // Get all records
    $carriers = Carrier::all();
    // Return a list of carriers as resource
    return CarrierResource::collection($carriers);
  }

}