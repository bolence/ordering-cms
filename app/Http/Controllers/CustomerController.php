<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::withCount('orders')->with('orders.delivery')->orderByDesc('created_at')->get();

        return view('customers.index', compact('customers'))->with(['title' => 'Mušterije']);
    }
}
