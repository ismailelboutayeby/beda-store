<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\QualityReport;
use Illuminate\Http\Request;

class QualityController extends Controller
{
    // 1. List completed orders to be evaluated
    public function index()
    {
        $orders = Order::where('status', 'shipped')
                        ->doesntHave('qualityReport')
                        ->get();
        return view('quality.index', compact('orders'));
    }

    // 2. Show form to evaluate one order
    public function evaluate($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('quality.evaluate', compact('order'));
    }

    // 3. Store evaluation
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'evaluation_score' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string',
        ]);

        QualityReport::create([
            'order_id' => $orderId,
            'evaluation_score' => $request->evaluation_score,
            'notes' => $request->notes,
        ]);

        return redirect()->route('quality.index')->with('succe
