<?php

namespace App\Http\Controllers;

use App\Models\EconomicCalendarSettings;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EconomicCalendarController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'from' => ['required', 'date_format:Y-m-d'],
            'to' => ['required', 'date_format:Y-m-d', 'after_or_equal:from'],
        ]);

        $settings = EconomicCalendarSettings::query()->first();
        $apiKey = $settings
            ? ($settings->enabled ? $settings->api_key : null)
            : config('services.finnhub.key');

        if (blank($apiKey)) {
            return response()->json([
                'data' => [],
                'configured' => false,
                'message' => 'Live economic events are not configured. Ask an administrator to add a Finnhub API key.',
            ], 503);
        }

        try {
            $response = Http::acceptJson()
                ->timeout(10)
                ->retry(2, 250)
                ->get('https://finnhub.io/api/v1/calendar/economic', [
                    'from' => $validated['from'],
                    'to' => $validated['to'],
                    'token' => $apiKey,
                ]);

            $response->throw();

            $events = collect($response->json('economicCalendar', []))
                ->map(function (array $event): array {
                    $dateTime = Carbon::parse($event['time'] ?? $event['date'] ?? 'now', 'UTC');

                    return [
                        'date' => $dateTime->toDateString(),
                        'time' => $dateTime->format('H:i'),
                        'currency' => strtoupper($event['country'] ?? 'N/A'),
                        'title' => $event['event'] ?? 'Economic event',
                        'note' => $event['unit'] ?? 'Economic release',
                        'impact' => $this->normalizeImpact($event['impact'] ?? null),
                        'previous' => $this->formatValue($event['prev'] ?? null),
                        'forecast' => $this->formatValue($event['estimate'] ?? null),
                        'actual' => $this->formatValue($event['actual'] ?? null),
                    ];
                })
                ->values();

            return response()->json(['data' => $events, 'configured' => true]);
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'data' => [],
                'configured' => true,
                'message' => 'The economic calendar provider is temporarily unavailable.',
            ], 502);
        }
    }

    private function normalizeImpact(?string $impact): string
    {
        return match (strtolower((string) $impact)) {
            'high' => 'high',
            'medium', 'moderate' => 'medium',
            default => 'low',
        };
    }

    private function formatValue(mixed $value): string
    {
        return $value === null || $value === '' ? '-' : (string) $value;
    }
}
