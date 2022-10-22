<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CashouReport extends Mailable
{
   use Queueable, SerializesModels;

   public $subject = 'HISTORIA CLÍNICA DEL PACIENTE';

 

   /**
     * Create a new message instance.
     *
     * @return void
    */
    public function __construct()
    {
     
    }

    /**
      * Build the message.
      *
      * @return $this
    */
    public function build()
    {
                  $pdf = PDF::loadView('emails.sale-invoice');

       $messageData = ['asdasdas'];
        $pdf = Mail::send('emails.sale-invoice', $messageData, function ($mail) use ($pdf) {
        $mail->from('rolandpm09@gmail.com', 'John Doe');
        $mail->to('rolandpm09@gmail.com');
        $mail->attachData($pdf->output(), 'test.pdf');
        });
        
            
    }
}