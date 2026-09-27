<?php

namespace App\Http\Controllers;

use App\Services\StripeCheckoutService;
use App\Services\StripeCredentials;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;
use Stripe\Exception\SignatureVerificationException;
use UnexpectedValueException;
use Throwable;

class StripeWebhookController
{
    public function __invoke(Request $request, StripeCheckoutService $stripe, StripeCredentials $credentials): JsonResponse
    {
        if (!$credentials->webhookSecrets()) {
            return response()->json(['message' => 'Stripe webhook is not configured.'], 503);
        }

        try {
            $stripe->processWebhook(
                $request->getContent(),
                (string) $request->header('Stripe-Signature'),
            );
        } catch (SignatureVerificationException|UnexpectedValueException $exception) {
            return response()->json(['message' => 'Invalid Stripe webhook signature.'], 400);
        } catch (RuntimeException $exception) {
            report($exception);

            return response()->json(['message' => 'Stripe webhook could not be processed.'], 503);
        } catch (Throwable $exception) {
            report($exception);

            return response()->json(['message' => 'Stripe webhook failed.'], 500);
        }

        return response()->json(['received' => true]);
    }
}
