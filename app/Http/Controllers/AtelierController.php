<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductionTask;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AtelierController extends Controller
{
    /**
     * List all orders ready for production.
     */
    public function index()
    {
        $orders = Order::where('status', 'validated_warehouse')->get();
        return view('atelier.orders.index', compact('orders'));
    }

    /**
     * Show a specific order and display the task assignment form.
     */
    public function show($orderId)
    {
        $order = Order::with(['product', 'client'])->findOrFail($orderId);
        $users = User::role('atelier_worker')->get(); // Ensure role exists
        return view('atelier.orders.show', compact('order', 'users'));
    }

    /**
     * Store the assigned task for the selected order.
     */
    public function storeTask(Request $request, $orderId)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'description' => 'required|string|max:1000',
        ]);

        ProductionTask::create([
            'order_id' => $orderId,
            'assigned_to' => $request->assigned_to,
            'description' => $request->description,
            'progress' => 0,
            'status' => 'pending',
        ]);

        // Update order status to in production
        $order = Order::findOrFail($orderId);
        $order->status = 'in_production';
        $order->save();

        return redirect()->route('atelier.orders.index')->with('success', 'Task assigned and order marked as in production.');
    }

    /**
     * Mark the order as ready for shipping.
     */
    public function markAsReady($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'ready_for_shipping';
        $order->save();

        return redirect()->route('atelier.orders.index')->with('success', 'Order marked as ready for shipping.');
    }
    public function exportTask($taskId)
{
    $task = \App\Models\ProductionTask::with(['order', 'user'])->findOrFail($taskId);

    $pdf = Pdf::loadView('pdf.task', compact('task'));

    return $pdf->download('task_' . $task->id . '.pdf');
}
}
