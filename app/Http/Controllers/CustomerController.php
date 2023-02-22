<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::withCount('orders')
            ->with('orders.delivery')
            ->orderByDesc('created_at')
            ->groupBy('name')
            ->get();

        return view('customers.index', compact('customers'))
            ->with(['title' => 'Mušterije']);
    }

    public function show($id)
    {
        $customer = Customer::with('orders')->findOrFail($id);
        return view('customers.customer', compact('customer'))
            ->with(['title' => 'Detalji mušterije']);
    }
}
