<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::all();
        $customers = Customer::all();
        $order_items = OrderItem::with('order')->orderByDesc('id')->limit(10)->get();
        $count_badges = OrderItem::whereType('bedž')->count();
        $count_tshirt = OrderItem::whereType('majica')->count();
        $order_statuses = DB::select('SELECT count(o.id) as status_count, status FROM orders o JOIN statuses s ON o.status_id = s.id GROUP BY o.status_id');
        $order_per_month_tshirt = DB::select('select count(id) as count_item from order_items where type = "majica" and deleted_at is null GROUP BY month(created_at), type');
        $order_per_month_badges = DB::select('select count(id) as count_item from order_items where type = "bedž" and deleted_at is null GROUP BY month(created_at), type');
        $tshirt_count_per_month = json_encode($order_per_month_tshirt, JSON_NUMERIC_CHECK);
        $badge_count_per_month = json_encode($order_per_month_badges, JSON_NUMERIC_CHECK);
        $statuses_json = json_encode($order_statuses, JSON_NUMERIC_CHECK);
        return view('welcome', compact('orders', 'customers', 'order_items', 'count_badges', 'count_tshirt', 'order_statuses', 'statuses_json', 'tshirt_count_per_month', 'badge_count_per_month'));
    }

    /**
     * Get user notifications
     *
     * @return Illuminate\Http\Response
     */
    public function notifications()
    {
        $notifications = auth()->user()->notifications->where('created_at', '>=' . NOW());
        $notifications = $notifications->sortByDesc('id')->take(5);
        $count_notifications = $notifications->count();

        return response()->json([
            'notifications' => $notifications,
            'count_notifications' => $count_notifications,
        ], 200);
    }
}
