<?php

namespace App\Listeners;

use App\Events\LotPurchasedEvent;
use App\Mail\Purchases\LotBought;
use Illuminate\Support\Facades\Mail;

class NotifyBuyer
{
    /**
     * Handle the event.
     *
     * @param  LotPurchasedEvent  $event
     * @return void
     */
    public function handle(LotPurchasedEvent $event)
    {
        Mail::to($event->buyer)
            ->send(new LotBought($event->lot, $event->purchase->price));
    }
}
