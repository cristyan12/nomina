<?php

namespace App\Http\Controllers;

class PostController
{
    public function __invoke()
    {
        return view('posts.create');
    }
}
