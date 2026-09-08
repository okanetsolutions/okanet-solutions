<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('presents products and security services with a contact path', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Software que resuelve.')
        ->assertSee('OkaISP')
        ->assertSee('OkaStore')
        ->assertSee('id="seguridad"', false)
        ->assertSee('Protección de ciberseguridad')
        ->assertSee(route('security'))
        ->assertSee(route('contact'))
        ->assertSee(route('products.okaisp'))
        ->assertSee(route('products.okastore'))
        ->assertDontSee('activity-log')
        ->assertDontSee('en vivo');
});
