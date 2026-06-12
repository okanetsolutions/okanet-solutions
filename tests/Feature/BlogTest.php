<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('shows published posts on the blog index', function () {
    $published = Post::factory()->create(['title' => 'Artículo publicado']);
    $draft = Post::factory()->draft()->create(['title' => 'Borrador secreto']);

    get('/blog')
        ->assertOk()
        ->assertSee('Artículo publicado')
        ->assertDontSee('Borrador secreto');
});

it('renders a post with markdown', function () {
    $post = Post::factory()->create([
        'body' => "## Un subtítulo\n\nTexto con **negrita**.",
    ]);

    get(route('blog.show', $post))
        ->assertOk()
        ->assertSee('<h2>Un subtítulo</h2>', false)
        ->assertSee('<strong>negrita</strong>', false);
});

it('hides drafts from guests but shows them to the admin', function () {
    $draft = Post::factory()->draft()->create();

    get(route('blog.show', $draft))->assertNotFound();

    actingAs(User::factory()->create())
        ->get(route('blog.show', $draft))
        ->assertOk();
});

it('requires login for the admin panel', function () {
    get('/admin/posts')->assertRedirect('/login');
});

it('lets the admin create, update and delete a post', function () {
    actingAs(User::factory()->create());

    post('/admin/posts', [
        'title' => 'Mi primer artículo',
        'slug' => '',
        'excerpt' => 'Un resumen.',
        'body' => 'Contenido del artículo.',
        'published' => '1',
    ])->assertRedirect();

    $post = Post::where('slug', 'mi-primer-articulo')->firstOrFail();
    expect($post->isPublished())->toBeTrue();

    \Pest\Laravel\put(route('admin.posts.update', $post), [
        'title' => 'Título editado',
        'slug' => $post->slug,
        'excerpt' => '',
        'body' => 'Contenido nuevo.',
        'published' => '0',
    ])->assertRedirect();

    expect($post->refresh()->title)->toBe('Título editado')
        ->and($post->isPublished())->toBeFalse();

    delete(route('admin.posts.destroy', $post))->assertRedirect(route('admin.posts.index'));
    expect(Post::count())->toBe(0);
});

it('authenticates with valid credentials', function () {
    $user = User::factory()->create(['password' => bcrypt('secret-123')]);

    post('/login', ['email' => $user->email, 'password' => 'secret-123'])
        ->assertRedirect(route('admin.posts.index'));

    expect(auth()->check())->toBeTrue();
});
