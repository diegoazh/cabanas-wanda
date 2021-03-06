<?php

namespace App\Listeners;

use App\BankingAccount;
use App\Events\NewRentalEvent;
use App\Mail\AlertNewRental;
use App\Mail\RentalSuccess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewRentalListener
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
     * @param  NewRentalEvent  $event
     * @return void
     */
    public function handle(NewRentalEvent $event)
    {
        $cuenta = BankingAccount::where('nro_cta', 'like', '300709%')->where('active', true)->first();
        $event->rental->banking = $cuenta;
        Mail::to($event->rental->user->email, $event->rental->user->formalFullName)->send(new RentalSuccess($event->rental));
        Mail::to('cabaniasdewanda@gmail.com', 'Administradores Hotel Cabañas de Wanda')->send(new AlertNewRental($event->rental));
    }
}
