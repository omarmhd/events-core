<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    public $invitation;
    public $tickets;
    public $event;

    public function __construct($invitation, $tickets,$event)
    {
        $this->invitation = $invitation;
        $this->tickets = $tickets;
        $this->event=$event;
    }

    public function build()
    {
        $email = $this->subject('Your Event Tickets')
            ->view('emails.tickets')
            ->with([
                'invitation' => $this->invitation,
                'tickets' => $this->tickets,
            ]);

        foreach ($this->tickets as $index => $ticket) {
            $email->attachData(
                base64_decode(explode(',', $ticket['qr'])[1]),
                $ticket['label'] . '.png',
                [
                    'mime' => 'image/png',
                    'content_id' => 'ticket' . $index,
                ]
            );
        }


        return $email;
    }

}
