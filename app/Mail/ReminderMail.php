<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lead;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('magloirekitio1@gmail.com')
            ->view('lead')
            ->with([
                'immatriculation' => $this->lead->immatriculation,
                'assuranceF' => $this->lead->assuranceF,
                  'cartegriseF' => $this->lead->cartegriseF,
                'visitetechniqueF' => $this->lead->visitetechniqueF,
            ]);
    }
}
