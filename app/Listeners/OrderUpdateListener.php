<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderFinishedNotification;

class OrderUpdateListener implements ShouldQueue
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->order->customer->notify(new OrderFinishedNotification($event->order));
        Cache::forget('finished_orders');
    }
}
