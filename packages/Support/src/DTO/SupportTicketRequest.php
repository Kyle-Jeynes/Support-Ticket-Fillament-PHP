<?php

namespace Package\Support\DTO;

use Package\Support\Models\SupportTicket;

class SupportTicketRequest
{
    public bool $status;
    public ?SupportTicket $support_ticket;
    public array $errors = [];
}