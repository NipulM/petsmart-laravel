<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function getAllCategories(): JsonResponse
    {
        try {
            $categories = Category::all();
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getCategoryById($id): JsonResponse
    {
        try {
            $category = Category::find($id);
            
            if ($category) {
                return response()->json([
                    'status' => 'success',
                    'data' => $category
                ]);
            }
            
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createNewCategory(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|min:3',
                'description' => 'required|min:10'
            ]);

            $category = Category::create($validated);
            
            return response()->json([
                'status' => 'success',
                'data' => $category
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 