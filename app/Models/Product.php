<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

  // Define the relation between Product and Order model, whit a Has and belongs to many relation.
  public function orders() {
    return $this->belongsToMany('App\Order', 'products_orders')->withPivot(["quantity"]);
  }

  // Define the relation between Product and Provider model, whit a Has and belongs to many relation.
  public function providers() {
    return $this->belongsToMany('App\Provider', 'products_providers');
  }

  // Define the relation between Product and Provider model, whit a Has and belongs to many relation.
  public function inventories() {
    return $this->hasMany('App\Inventory');
  }

  // Returns the list of products by date, with a order by quantity (Assumming that the quantity is the amount of products sold)
  public static function getOrderedSelledProductsByDate($date, $order) {
    return Product::leftJoin('products_orders', 'products.id', '=', 'products_orders.product_id')
      ->leftJoin('orders', 'products_orders.order_id', '=', 'orders.id')
      ->where('orders.deliverDate', $date)
      ->orderBy('products_orders.quantity', $order)
      ->get(['products.id', 'products.name', 'products_orders.quantity']);
  }

  // Returns the list of products by order, with their respective availability.
  public static function getProductsAvailability($order_id, $operator) {
    return Product::leftJoin('products_orders', 'products.id', '=', 'products_orders.product_id')
      ->leftJoin('orders', 'products_orders.order_id', '=', 'orders.id')
      ->leftJoin('inventories', 'inventories.product_id', '=', 'products.id')
      ->where([
        ['orders.id', '=', $order_id],
        ['products_orders.quantity', $operator, 'inventories.quantity']
      ])
      ->get(['products.id', 'products.name', 'products_orders.quantity as order_quantity', 'inventories.quantity as inventory_quantity']);
  }

}
