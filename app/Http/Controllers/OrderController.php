<?php

namespace App\Http\Controllers;

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
     * Create an order
     *
     * @return void
     */
    public function create()
    {
        return view('orders.create')->with(['title' => 'Napravi porudžbenicu']);
    }
}
