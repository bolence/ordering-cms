<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\OrderFinishedNotification;
use App\Notifications\OrderFinishedDBNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

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

        info($event->order->customer->email);
        $event->order->customer->notify(new OrderFinishedNotification($event->order));
        // foreach (User::all() as $user) {
        //     $user->notify(new OrderFinishedDBNotification($event->order));
        // }
        $event->order->finished_at = now()->format('d.m.Y H:m:s');
        $event->order->save();
        Cache::forget('finished_orders');
    }
}
