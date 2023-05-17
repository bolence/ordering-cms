<?php

namespace App\Services;

use App\Models\Delivery;

class DeliveryService
{

    /**
     * Update delivery
     *
     * @param \Models\Order $order
     * @param [type] $request
     * @return void
     */
    public static function createOrUpdateDelivery($order, $request)
    {
        if ($request->delivery) {
            $order->delivery()->updateOrCreate(['order_id' => $order->id], $request->delivery);
        }

        if ($request->delivery_type !== 'Dostava') {
            $order->delivery->delete();
        }
    }
}
