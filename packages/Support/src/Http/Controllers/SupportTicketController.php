<?php

namespace Package\Support\Http\Controllers;

use Package\Support\Contracts\SupportServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SupportTicketController
{
    public function __construct(private SupportServiceContract $support_service_contract)
    {

    }

    public function createSupportTicket(Request $request): JsonResponse
    {
        return response()->json([
            // ...
        ]);
    }
}