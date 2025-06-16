<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductionTask;
use App\Models\User;
use Illuminate\Http\Request;

class AtelierController extends Controller
{
    // 1. View orders ready for production
    public function index()
    {
        $orders = Order::where('status', 'validated_warehouse')->get();
        return view('atelier.orders.index', compact('orders'));
    }

    // 2. Assign production tasks
    public function assignTasks($orderId)
    {
        $order = Order::findOrFail($orderId);
        $users = User::role('atelier_worker')->get(); // make sure this role exists
        return view('atelier.orders.assign', compact('order', 'users'));
    }

    // 3. Store assigned task
    public function storeTask(Request $request, $orderId)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'description' => 'required|string',
        ]);

        ProductionTask::create([
            'order_id' => $orderId,
            'assigned_to' => $request->assigned_to,
            'description' => $request->description,
            'progress' => 0,
            'status' => 'pending',
        ]);

        // Set order status
        $order = Order::findOrFail($orderId);
        $order->status = 'in_production';
        $order->save();

        return redirect()->route('atelier.orders.index')->with('success', 'Task assigned.');
    }

    // 4. Mark production as complete
    public function markAsReady($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'ready_for_shipping';
        $order->save();

        return redirect()->route('atelier.orders.index')->with('success', 'Order marked as ready for shipping.');
    }
}
