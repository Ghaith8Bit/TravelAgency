<?php

namespace App\Http\Controllers;

use App\Models\Rating;

class BlogController extends Controller
{

    public function index()
    {
        $ratings = Rating::paginate(8);

        return view('dashboard.ratings.index', ['ratings' => $ratings]);
    }

    public function showOnBlog(Rating $rating)
    {
        $rating->update([
            'show_on_blog' => $rating->show_on_blog ? 0 : 1,
        ]);

        return redirect()->back()->with('success', 'Rating visibility updated successfully.');
    }

}
