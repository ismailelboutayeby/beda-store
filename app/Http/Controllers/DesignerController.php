<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignerController extends Controller
{
    /**
     * Display all orders needing design validation.
     */
    public function index()
    {
        $orders = Order::where('status', 'pending_design')
                       ->with(['product', 'client']) // eager-load relationships
                       ->get();

        return view('designer.orders.index', compact('orders'));
    }

    /**
     * Show the details of a specific order.
     */
    public function show($id)
    {
        $order = Order::with(['product', 'client'])->findOrFail($id);

        return view('designer.orders.show', compact('order'));
    }

    /**
     * Approve or reject the order after design analysis.
     */
    public function process(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($request->input('action') === 'approve') {
            $order->status = 'validated_design';
            $order->assigned_designer_id = Auth::id();
        } else {
            $order->status = 'rejected_design';
        }

        $order->save();

        return redirect()->route('designer.orders.index')->with('success', 'Order processed.');
    }
}
