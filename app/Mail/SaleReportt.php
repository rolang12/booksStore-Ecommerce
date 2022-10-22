<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class SaleReportt extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "¡Invoice - Thanks for your purchase!";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
        $data = [
            'titulo' => 'Styde.net'
        ];

        $pdf = PDF::loadView('emails.sale-invoice', $data);

        return $pdf->download('archivo.pdf');

    }
}
