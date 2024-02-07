<?php

namespace Package\Support\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Package\Support\DTO\SupportTicketRequest;

class SupportService implements \Package\Support\Contracts\SupportServiceContract
{
    private ?string $email_address = null;
    private ?string $first_name = null;
    private ?string $last_name = null;
    private ?string $content = null;
    private ?string $ip_address = null;
    private ?string $request_user_agent = null;

    // TODO: Move request depedency into controller
    //       Create setters for ip and user agent and add to concern
    public function __construct(private Request $request, private SupportTicketRequest $support_ticket_request)
    {
        [$this->ip_address, $this->request_user_agent] = [
            $this->request->ip(),
            $this->request->userAgent()
        ];
    }

    public function setEmail(string $email_address): static
    {
        $this->email_address = $email_address;
        return $this;
    }

    public function setName(string $first_name, string $last_name): static
    {
        [$this->first_name, $this->last_name] = compact('first_name', 'last_name');
        return $this;
    }

    public function setRequestContent(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function requestSupportTicket(): SupportTicketRequest
    {
        if (($validator = Validator::make($this->toArray(), $this->validation()))->fails()) {
            [$this->support_ticket_request->status, $this->support_ticket_request->errors] = [
                false,
                $validator->errors(),
            ];

            return $this->support_ticket_request;
        }

        [$this->support_ticket_request->status, $this->support_ticket_request->support_ticket] = [
            true,
            \Package\Support\Models\SupportTicket::query()->create($this->toArray()),
        ];

        return $this->support_ticket_request;
    }

    private function validation(): array
    {
        return [
            'email_address' => 'required|string|email',
            'first_name' => 'required|string|min:3',
            'last_name' => 'sometimes|required|string|min:3',
            'content' => 'required|string|max:500',
            'ip_address' => 'sometimes|required|string',
            'request_user_agent' => 'sometimes|required|string'
        ];
    }

    private function toArray(): array
    {
        [$email_address, $first_name, $last_name, $content, $ip_address, $request_user_agent] = [
            $this->email_address,
            $this->first_name,
            $this->last_name,
            $this->content,
            $this->ip_address,
            $this->request_user_agent
        ];

        return compact('email_address', 'first_name', 'last_name', 'content', 'ip_address', 'request_user_agent',);
    }
}