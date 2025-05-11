<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription.index');
    }

    public function getAllSubscriptions(): JsonResponse
    {
        try {
            $subscriptions = Subscription::all();
            return response()->json([
                'status' => 'success',
                'data' => $subscriptions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getSubscriptionById(int $subscription_id): JsonResponse
    {
        try {
            $subscription = Subscription::findOrFail($subscription_id);
            return response()->json([
                'status' => 'success',
                'data' => $subscription
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createSubscription(Request $request): JsonResponse
    {
        try {
            $subscription = Subscription::create($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $subscription
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
