<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\IndicatorAccessRequest;
use App\Services\IndicatorAccessDelivery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class IndicatorAccessRequestController
{
    public function store(Request $request, Indicator $indicator, IndicatorAccessDelivery $delivery): RedirectResponse
    {
        abort_unless($indicator->is_active && !$indicator->is_paid, 404);

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $accessRequest = IndicatorAccessRequest::create([
            'indicator_id' => $indicator->id,
            'indicator_name' => $indicator->name,
            'name' => $data['name'] ?? null,
            'email' => $data['email'],
            'message' => $data['message'] ?? null,
            'status' => 'new',
        ]);

        try {
            $delivery->notifyAdminOfFreeRequest($accessRequest);
        } catch (Throwable $exception) {
            report($exception);
            Log::error('Free indicator request saved, but admin email notification failed.', [
                'request_id' => $accessRequest->id,
            ]);
        }

        return to_route('indicators.index')
            ->with('access_request_sent', 'Your request was received. The team will review it and email you if approved.');
    }
}
