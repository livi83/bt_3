<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about-us', function () {
    return view('about-us',['nazov_firmy' => 'Srbská Delegácia']);
});

Route::get('/blog', function () {
    $posts = [
        ['title' => 'Prvý článok', 'excerpt' => 'Toto je krátky popis prvého článku.'],
        ['title' => 'Druhý článok', 'excerpt' => 'Toto je krátky popis druhého článku.'],
        ['title' => 'Tretí článok', 'excerpt' => 'Toto je krátky popis tretieho článku.'],
    ];

    return view('blog', ['posts' => $posts]);
});