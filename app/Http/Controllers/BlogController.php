<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $ratings = Rating::all();
        return view('website.pages.blogs.index', ['ratings' => $ratings]);
    }
}
