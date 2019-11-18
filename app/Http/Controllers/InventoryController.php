<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Inventory;
use App\Http\Resources\Inventory as InventoryResource;

class InventoryController extends Controller {

  /**
   * Display a listing inventories available in inventories table.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    // Get all records
    $inventories = Inventory::all();
    // Return a list of inventories as a resource
    return InventoryResource::collection($inventories);
  }

}