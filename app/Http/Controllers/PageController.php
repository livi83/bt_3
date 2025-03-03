<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function index()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('contact');
    }
    
    public function aboutUs()
    {
        return view('about-us', ['blog_name' => 'UKF Blog']);
    }

    public function blog()
    {
        $posts = [
            ['id' => 1, 'title' => 'Prvý článok', 'excerpt' => 'Toto je krátky popis prvého článku.'],
            ['id' => 2, 'title' => 'Druhý článok', 'excerpt' => 'Toto je krátky popis druhého článku.'],
            ['id' => 3, 'title' => 'Tretí článok', 'excerpt' => 'Toto je krátky popis tretieho článku.'],
        ];
        return view('blog', ['posts' => $posts]);
    }

    public function showBlog($id)
    {
        $posts = [
            1 => ['title' => 'Prvý článok', 'excerpt' => 'Toto je celý text prvého článku.'],
            2 => ['title' => 'Druhý článok', 'excerpt' => 'Toto je celý text druhého článku.'],
            3 => ['title' => 'Tretí článok', 'excerpt' => 'Toto je celý text tretieho článku.'],
        ];

        if (!array_key_exists($id, $posts)) {
            abort(404);
        }

        return view('blog-detail', ['post' => $posts[$id]]);
    }


}
