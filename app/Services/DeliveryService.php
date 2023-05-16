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
    }

    /**
     * Delete delivery if person delivery choosen
     *
     * @param [type] $orderId
     * @return Eloquent
     */
    protected static function deleteDelivery($orderId)
    {
        Delivery::whereOrderId($orderId)->delete();
    }
}
