<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('order_items', 'customer')
        ->withCount('order_items')
        ->withSum('order_items', 'quantity')
        ->groupBy('order_number')
        ->get();

        return view('orders.index', compact('orders'))->with(['title' => 'Spisak poručenih majica']);
    }

    /**
     * Undocumented function
     *
     * @param int $id
     * @return Illuminate\Response\View
     */
    public function show(int $id)
    {
        $order = Order::findOrFail($id);
        // $statuses = Status::orderByDesc('id')->get();
        return view('orders.order', compact('order'))->with(['title' => 'Detalji porudžbine ' . $order->order_number]);
    }

    /**
     * Create an order
     *
     * @return void
     */
    public function create()
    {
        return view('orders.create')->with(['title' => 'Napravi porudžbenicu']);
    }
}
