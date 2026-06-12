<?php

use App\Models\Post;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('issues a token with valid credentials', function () {
    $user = User::factory()->create(['password' => bcrypt('secret-123')]);

    postJson('/api/auth/token', [
        'email' => $user->email,
        'password' => 'secret-123',
        'device_name' => 'tests',
    ])->assertCreated()->assertJsonStructure(['token']);
});

it('rejects a token request with bad credentials', function () {
    $user = User::factory()->create();

    postJson('/api/auth/token', [
        'email' => $user->email,
        'password' => 'wrong',
        'device_name' => 'tests',
    ])->assertUnprocessable();
});

it('lists only published posts publicly', function () {
    Post::factory()->count(2)->create();
    Post::factory()->draft()->create();

    getJson('/api/posts')
        ->assertOk()
        ->assertJsonCount(2, 'data')
        ->assertJsonStructure(['data' => [['id', 'title', 'slug', 'body', 'body_html', 'published', 'url']]]);
});

it('includes drafts for authenticated requests when asked', function () {
    Post::factory()->count(2)->create();
    Post::factory()->draft()->create();

    Sanctum::actingAs(User::factory()->create());

    getJson('/api/posts?include=drafts')->assertOk()->assertJsonCount(3, 'data');
});

it('shows a published post by slug and hides drafts from guests', function () {
    $post = Post::factory()->create(['slug' => 'hola-mundo']);
    $draft = Post::factory()->draft()->create();

    getJson('/api/posts/hola-mundo')->assertOk()->assertJsonPath('data.slug', 'hola-mundo');
    getJson("/api/posts/{$draft->slug}")->assertNotFound();
});

it('blocks writes without a token', function () {
    postJson('/api/posts', ['title' => 'X', 'body' => 'Y'])->assertUnauthorized();
});

it('creates, updates and deletes a post with a token', function () {
    Sanctum::actingAs(User::factory()->create());

    $created = postJson('/api/posts', [
        'title' => 'Post desde la API',
        'body' => "## Hola\n\nContenido.",
        'published' => true,
    ])->assertCreated()->assertJsonPath('data.slug', 'post-desde-la-api');

    $slug = $created->json('data.slug');

    putJson("/api/posts/{$slug}", [
        'title' => 'Post editado',
        'slug' => $slug,
        'body' => 'Nuevo contenido.',
        'published' => false,
    ])->assertOk()->assertJsonPath('data.published', false);

    deleteJson("/api/posts/{$slug}")->assertNoContent();
    expect(Post::count())->toBe(0);
});

it('revokes the current token', function () {
    $user = User::factory()->create(['password' => bcrypt('secret-123')]);

    $token = postJson('/api/auth/token', [
        'email' => $user->email,
        'password' => 'secret-123',
        'device_name' => 'tests',
    ])->json('token');

    deleteJson('/api/auth/token', [], ['Authorization' => "Bearer {$token}"])->assertNoContent();

    expect($user->tokens()->count())->toBe(0);
});
