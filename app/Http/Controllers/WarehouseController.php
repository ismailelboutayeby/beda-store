<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    // 1. Show orders waiting for warehouse validation
    public function index()
    {
        $orders = Order::where('status', 'validated_design')->get();
        return view('warehouse.orders.index', compact('orders'));
    }

    // 2. Show order details
    public function show($id)
    {
        $order = Order::with('product')->findOrFail($id);
        return view('warehouse.orders.show', compact('order'));
    }

    // 3. Validate or reject an order based on stock
    public function validateOrder(Request $request, $id)
    {
        $order = Order::with('product')->findOrFail($id);
        $product = $order->product;

        if ($product->quantity >= 1) {
            // Enough stock, approve order
            $product->quantity -= 1;
            $product->save();

            $order->status = 'validated_warehouse';
        } else {
            // Not enough stock, reject order
            $order->status = 'rejected_warehouse';
        }

        $order->save();

        return redirect()->route('warehouse.orders.index')->with('success', 'Order updated.');
    }
}
