<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\SubscriptionBox;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscriptionBoxController extends Controller
{
    public function createSubscriptionBox(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'subscription_id' => 'required|integer',
                'total_amount' => 'required|numeric',
                'order_items' => 'required|array',
                'start_date' => 'required|date',
                'expiry_date' => 'required|date',
                'customer_name' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed: ' . json_encode($validator->errors()));
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->all();

            // Ensure dates are properly formatted
            $data['start_date'] = date('Y-m-d H:i:s', strtotime($data['start_date']));
            $data['expiry_date'] = date('Y-m-d H:i:s', strtotime($data['expiry_date']));

            Log::info('Creating subscription box with data: ' . json_encode($data));

            $subscriptionBox = SubscriptionBox::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Subscription box created successfully',
                'data' => $subscriptionBox
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating subscription box: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create subscription box',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getSubscriptionBoxesByUserId(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $subscriptionBoxes = SubscriptionBox::where('user_id', $userId)->get();
        return response()->json($subscriptionBoxes);
    }
}
