<?php

namespace App\Listeners;

use App\BankingAccount;
use App\Events\RentalUpdateEvent;
use App\Mail\AlertUpdatedRental;
use App\Mail\RentalUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RentalUpdateListener
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
     * @param  RentalUpdateEvent  $event
     * @return void
     */
    public function handle(RentalUpdateEvent $event)
    {
        $cuenta = BankingAccount::where('nro_cta', 'like', '300709%')->where('active', true)->first();
        $event->rental->banking = $cuenta;
        Mail::to($event->rental->user->email, $event->rental->user->formalFullName)->send(new RentalUpdated($event->rental));
        Mail::to('cabaniasdewanda@gmail.com', 'Administradores Hotel Cabañas de Wanda')->send(new AlertUpdatedRental($event->rental));
    }
}
