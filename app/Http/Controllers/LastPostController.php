<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LastPostController extends Controller
{
    public function index()
    {
        return Post::latest()->limit(6)->get();
    }
}
