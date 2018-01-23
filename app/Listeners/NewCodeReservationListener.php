<?php

namespace App\Listeners;

use App\Mail\NewRentalCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewCodeReservationListener
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
    public function handle($event)
    {
        Mail::to($event->rental->user->email, $event->rental->user->formalFullName)
            ->send(new NewRentalCode($event->rental, $event->code));
    }
}
