<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('order_items')->withCount('order_items')->with('customer')->withSum('order_items', 'quantity')->groupBy('order_number')->get();

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
        $order = Order::with('order_items', 'delivery', 'customer', 'status')->findOrFail($id);
        $statuses = Status::orderByDesc('id')->get();
        return view('orders.order', compact('order', 'statuses'))->with(['title' => 'Detalji porudžbine ' . $order->order_number]);
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
