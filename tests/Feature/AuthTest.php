<?php

use App\Models\User;

test('guest can view the login screen', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Ingreso al sistema');
});

test('user can log in with valid credentials', function () {
    $user = User::factory()->create([
        'password' => 'password123',
    ]);

    $this->post(route('login.post'), [
        'email' => $user->email,
        'password' => 'password123',
    ])->assertRedirect(route('login'));

    $this->assertAuthenticatedAs($user);
});

test('user cannot log in with invalid credentials', function () {
    $user = User::factory()->create([
        'password' => 'password123',
    ]);

    $this->from(route('login'))
        ->post(route('login.post'), [
            'email' => $user->email,
            'password' => 'incorrecta',
        ])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('authenticated user can still view the login screen', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('login'))
        ->assertOk()
        ->assertSee('Ingreso al sistema');
});
