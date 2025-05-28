<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog');
    }

    public function blog_detail()
    {
        return view('blog-detail');
    }
}
