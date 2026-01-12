<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationQr extends Model
{
    use HasFactory;
    protected $table = 'invitation_qrs';
    protected $guarded=[''];

}
