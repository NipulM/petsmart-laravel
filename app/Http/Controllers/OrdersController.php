<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'order_items' => 'required|array',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
            'created_at' => 'required|date',
            'delivered_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $orderData = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'order_items' => json_encode($request->order_items),
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'created_at' => $request->created_at,
            'delivered_at' => $request->delivered_at,
        ];

        // Send to MongoDB API
        $endpoint = config('services.mongodb.endpoint') . '/action/insertOne';
        $apiKey = config('services.mongodb.key');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => $apiKey,
        ])->post($endpoint, [
            'dataSource' => 'PetsmartCluster',
            'database' => 'petsmart',
            'collection' => 'orders',
            'document' => $orderData
        ]);

        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Order saved successfully',
                'data' => $response->json()
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save order',
                'details' => $response->body()
            ], 500);
        }
    }
}
