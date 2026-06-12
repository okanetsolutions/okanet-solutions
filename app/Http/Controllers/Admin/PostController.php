<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $post = Post::create($this->validated($request));

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Artículo creado.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($this->validated($request, $post));

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Artículo actualizado.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Artículo eliminado.');
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug'.($post ? ','.$post->id : '')],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'published' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);

        // Keep the original publish date when re-saving an already published post.
        $data['published_at'] = $request->boolean('published')
            ? ($post?->published_at ?? now())
            : null;

        unset($data['published']);

        return $data;
    }
}
