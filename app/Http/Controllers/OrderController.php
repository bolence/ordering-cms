<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('order_items', 'customer', 'status')
            ->withCount('order_items')
            ->withSum('order_items', 'quantity')
            ->where('status_id', '!=', 5)
            ->groupBy('order_number')
            ->orderByDesc('id')
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


    /**
     * Finished orders
     *
     * @return View
     */
    public function finished_orders()
    {

        $orders = Cache::rememberForever('finished_orders', function () {
            return Order::with('order_items', 'customer', 'status')
                ->withCount('order_items')
                ->withSum('order_items', 'quantity')
                ->whereStatusId(5)
                ->groupBy('order_number')
                ->orderByDesc('id')
                ->get();
        });

        return view('orders.finished', compact('orders'))->with(['title' => 'Isporučene porudžbenicu']);
    }
}
