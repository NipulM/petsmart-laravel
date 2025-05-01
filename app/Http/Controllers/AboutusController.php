<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Blog;

class AboutusController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('about-us.index', compact('blogs'));
    }
}
