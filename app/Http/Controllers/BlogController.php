<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllBlogPosts(): JsonResponse
    {
        try {
            $blogs = Blog::all();
            return response()->json([
                'status' => 'success',
                'data' => $blogs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getBlogPostById(int $blog_id): JsonResponse
    {
        try {
            $blog = Blog::findOrFail($blog_id);
            return response()->json([
                'status' => 'success',
                'data' => $blog
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createBlogPost(Request $request): JsonResponse
    {
        try {
            $blog = Blog::create($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $blog
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
