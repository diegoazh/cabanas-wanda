<?php

namespace App\Mail;

use App\Rental;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRentalCode extends Mailable
{
    use Queueable, SerializesModels;
    public $rental;
    public $code;

    /**
     * Create a new message instance.
     * @param Rental $rental
     * @param Integer $code
     *
     * @return void
     */
    public function __construct(Rental $rental, $code)
    {
        $this->rental = $rental;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.rentals.new-rental-code')->subject('Nuevo código de reserva');
    }
}
