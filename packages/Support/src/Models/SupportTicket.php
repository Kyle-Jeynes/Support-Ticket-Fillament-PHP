<?php

namespace Package\Support\Models;

use Illuminate\Database\Eloquent\Model;

#[\Package\Support\Attributes\DispatchableEmailAttribute(view: 'Support::new-ticket-submission', subject: 'New: Support Ticket Request')]
class SupportTicket extends Model
{
    use \Package\Support\Traits\ShouldDispatchEmail;

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'ip_address',
        'request_content',
        'request_user_agent'
    ];
}