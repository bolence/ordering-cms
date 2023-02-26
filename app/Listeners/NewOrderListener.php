<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use Illuminate\Support\Facades\Cache;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;


class NewOrderListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        $event->order->customer->notify(new NewOrderNotification($event->order));
        Cache::forget('finished_orders');
    }
}
