<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('passes if credentials are correct', function () {
    User::create([
        'name' => 'root',
        'email' => 'root@succ.ess',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post('/login', [
        'name' => 'root',
        'password' => 'password'
    ]);

    $response->assertRedirect('/breweries');
    $this->assertNotNull(session('token'));
});

it('fails if credentials are wrong', function () {
    User::create([
        'name' => 'root',
        'email' => 'root@fa.ils',
        'password' => Hash::make('password'),
    ]);

    $response = $this->post('/login', [
        'name' => 'some_fake_user',
        'password' => 'wrong_password'
    ]);

    $response->assertSessionHasErrors();
    $this->assertNull(session('token'));
});
