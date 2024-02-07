<?php

namespace Package\Support\Contracts;

interface SupportServiceContract
{
    public function setEmail(string $email_address): SupportServiceContract;
    public function setName(string $first_name, string $last_name): SupportServiceContract;
    public function setRequestContent(string $content): SupportServiceContract;
    public function requestSupportTicket(): \Package\Support\DTO\SupportTicketRequest;
}