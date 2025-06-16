<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class LogisticsController extends Controller
{
    // 1. List orders ready to ship
    public function index()
    {
        $orders = Order::where('status', 'ready_for_shipping')->get();
        return view('logistics.orders.index', compact('orders'));
    }

    // 2. Show assignment form
    public function assign($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('logistics.orders.assign', compact('order'));
    }

    // 3. Store shipment info
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'driver_name' => 'required|string',
            'vehicle' => 'required|string',
            'tracking_link' => 'nullable|string',
        ]);

        Shipment::create([
            'order_id' => $orderId,
            'driver_name' => $request->driver_name,
            'vehicle' => $request->vehicle,
            'tracking_link' => $request->tracking_link,
            'status' => 'in_transit',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = 'shipped';
        $order->save();

        return redirect()->route('logistics.orders.index')->with('success', 'Shipment assigned and order shipped.');
    }

    // 4. Mark as delivered (optional)
    public function markDelivered($shipmentId)
    {
        $shipment = Shipment::findOrFail($shipmentId);
        $shipment->status = 'delivered';
        $shipment->save();

        return redirect()->back()->with('success', 'Shipment marked as delivered.');
    }
}
