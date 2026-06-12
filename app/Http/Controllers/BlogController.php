<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->isPublished() || auth()->check(), 404);

        return view('blog.show', compact('post'));
    }
}
