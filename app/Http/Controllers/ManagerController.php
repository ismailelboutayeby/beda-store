<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Invoice;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $ordersCount = Order::count();
        $stockLevel = Stock::sum('quantity');
        $pendingDeliveries = Order::where('status', 'pending_delivery')->count();
        $invoicesCount = Invoice::count();

        return view('manager.dashboard', compact('ordersCount', 'stockLevel', 'pendingDeliveries', 'invoicesCount'));
    }
}
