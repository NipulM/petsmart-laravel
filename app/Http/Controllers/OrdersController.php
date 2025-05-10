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

    public function getUserOrders(Request $request): JsonResponse
    {
        $userId = Auth::id();

        $status = $request->query('status');
        $limit = $request->query('limit', 20);
        $skip = $request->query('skip', 0);

        $filter = ['user_id' => $userId];

        if ($status) {
            $filter['status'] = $status;
        }

        $endpoint = config('services.mongodb.endpoint') . '/action/find';
        $apiKey = config('services.mongodb.key');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => $apiKey,
        ])->post($endpoint, [
            'dataSource' => 'PetsmartCluster',
            'database' => 'petsmart',
            'collection' => 'orders',
            'filter' => $filter,
            'sort' => ['created_at' => -1],
            'limit' => (int) $limit,
            'skip' => (int) $skip
        ]);

        if ($response->successful()) {
            $orders = $response->json('documents', []);

            foreach ($orders as &$order) {
                if (isset($order['order_items']) && is_string($order['order_items'])) {
                    $order['order_items'] = json_decode($order['order_items'], true);
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'orders' => $orders,
                    'total' => count($orders),
                    'limit' => (int) $limit,
                    'skip' => (int) $skip
                ]
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch orders',
                'details' => $response->body()
            ], 500);
        }
    }
}
