<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Post; // Nezabudni importovať model Post
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::latest()->paginate(6); // Načítaj najnovších 6 príspevkov s pagináciou
        return view('welcome', compact('posts')); // Odovzdaj premennú $posts do view
    }
}