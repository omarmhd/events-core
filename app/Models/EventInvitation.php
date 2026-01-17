<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

class EventInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'company_id',
        'invitee_name',
        'invitee_email',
        'invitee_phone',
        'invitee_position',
        'invitee_nationality',
        'status',
        'allowed_guests',
        'selected_guests',
        'responded_at',
        'invitation_token'
    ];

    public function InvitationQrs(){

        return $this->hasMany(InvitationQr::class);
    }


}
