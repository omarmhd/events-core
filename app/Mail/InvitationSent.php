<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\EventInvitation;
use App\Models\Eve;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationSent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public EventInvitation $invitation;
    public string $invitationLink;
    public Event $event;
    /**
     * Create a new message instance.
     */
    public function __construct(EventInvitation $invitation, string $invitationLink,Event $event)
    {
        $this->invitation = $invitation;
        $this->invitationLink = $invitationLink;
        $this->event = $event;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('You are invited! -'.$this->event->title_en)
            ->view('emails.invitation');
    }
}
