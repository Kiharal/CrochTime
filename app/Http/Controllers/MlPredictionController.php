<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class MlPredictionController extends Controller
{
    public function predict(Request $request, Order $record)
    {
        $response = Http::timeout(10)
            ->post(config('services.ml.url') . '/predict', [
                'features' => $record->toMlFeatures(), // see below
            ]);

        if ($response->failed()) {
            report(new \RuntimeException("ML service error: {$response->body()}"));
            return response()->json(['error' => 'Prediction failed'], 502);
        }

        return response()->json($response->json());
    }
}