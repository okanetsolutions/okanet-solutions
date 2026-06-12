<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Public listing: published posts only. Authenticated requests
     * can pass ?include=drafts to list everything.
     */
    public function index(Request $request)
    {
        $query = $request->user() && $request->query('include') === 'drafts'
            ? Post::query()
            : Post::published();

        return PostResource::collection(
            $query->latest('published_at')->latest('id')->paginate(15)
        );
    }

    public function show(Request $request, Post $post)
    {
        abort_unless($post->isPublished() || $request->user(), 404);

        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $post = Post::create($this->validated($request));

        return (new PostResource($post))->response()->setStatusCode(201);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($this->validated($request, $post));

        return new PostResource($post->refresh());
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
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

        $data['slug'] = Str::slug(($data['slug'] ?? null) ?: $data['title']);

        // Keep the original publish date when re-saving an already published post.
        $data['published_at'] = $request->boolean('published')
            ? ($post?->published_at ?? now())
            : null;

        unset($data['published']);

        return $data;
    }
}
