<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\SubscriptionBox;
use Illuminate\Support\Facades\Auth;

class SubscriptionBoxController extends Controller
{
    public function createSubscriptionBox(Request $request): JsonResponse
    {
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
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['order_items'] = json_encode($data['order_items']);

        $subscriptionBox = SubscriptionBox::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Subscription box created successfully',
            'data' => $subscriptionBox
        ], 201);
    }

    public function getSubscriptionBoxesByUserId(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $subscriptionBoxes = SubscriptionBox::where('user_id', $userId)->get();
        return response()->json($subscriptionBoxes);
    }
}
