<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Shipment;
use Illuminate\Http\Request;

class GeneralManagerController extends Controller
{
    // Dashboard showing KPIs
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', '!=', 'shipped')->count(),
            'products_low_stock' => Product::where('quantity', '<=', 10)->get(),
            'unpaid_invoices' => Invoice::where('payment_status', 'pending')->count(),
            'shipments_in_transit' => Shipment::where('status', 'in_transit')->count(),
        ];

        return view('general.dashboard', compact('stats'));
    }
}
