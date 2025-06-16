<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // 1. List all invoices
    public function index()
    {
        $invoices = Invoice::with('order')->get();
        return view('invoices.index', compact('invoices'));
    }

    // 2. Show details of one invoice
    public function show($id)
    {
        $invoice = Invoice::with('order')->findOrFail($id);
        return view('invoices.show', compact('invoice'));
    }

    // 3. Mark invoice as paid
    public function markPaid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'paid';
        $invoice->paid_at = now();
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'Invoice marked as paid.');
    }

    // 4. Mark invoice as failed
    public function markFailed($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->payment_status = 'failed';
        $invoice->save();

        return redirect()->route('invoices.index')->with('error', 'Invoice marked as failed.');
    }
}
