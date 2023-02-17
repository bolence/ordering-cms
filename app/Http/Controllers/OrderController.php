<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Status;
use App\Models\OrderItem;

class OrderController extends Controller
{

    public function tshirt()
    {
        $orders = OrderItem::whereType('majica')->with('order.customer')->get();

        return view('orders.tshirt', compact('orders'))->with(['title' => 'Spisak poručenih majica']);
    }


    public function badges()
    {
        $orders = OrderItem::whereType('bedž')->with('order.customer')->get();

        return view('orders.badges', compact('orders'))->with(['title' => 'Spisak poručenih bedževa']);
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
