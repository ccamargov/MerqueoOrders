<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Carrier;
use App\Http\Resources\Carrier as CarrierResource;

class CarrierController extends Controller {

  /**
   * Display a listing carriers available in Carriers table.
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