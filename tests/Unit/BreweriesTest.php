<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('retrieves correctly 20 breweries if authenticated', function () {
    User::create([
        'name' => 'root',
        'email' => 'root@succ.ess',
        'password' => Hash::make('password'),
    ]);

    $this->post('/login', [
        'name' => 'root',
        'password' => 'password'
    ]);

    $token = session('token');

    $response = $this->get('/breweries', ['Authorization' => "Bearer $token"]);

    $response->assertStatus(200);
    $response->assertViewHas('breweries', function ($breweries) {
        return count($breweries) == 20;
    });
});

it('retrieves correctly "per_page" breweries if per_page value is passed as query param', function () {
    User::create([
        'name' => 'root',
        'email' => 'root@succ.ess',
        'password' => Hash::make('password'),
    ]);

    $this->post('/login', [
        'name' => 'root',
        'password' => 'password'
    ]);

    $token = session('token');

    $response = $this->get('/breweries?per_page=15', ['Authorization' => "Bearer $token"]);

    $response->assertStatus(200);
    $response->assertViewHas('breweries', function ($breweries) {
        return count($breweries) == 15;
    });
});

it('retrieves correctly first result of first page of breweries', function () {
    User::create([
        'name' => 'root',
        'email' => 'root@succ.ess',
        'password' => Hash::make('password'),
    ]);

    $this->post('/login', [
        'name' => 'root',
        'password' => 'password'
    ]);

    $token = session('token');

    $response = $this->get('/breweries?page=1', ['Authorization' => "Bearer $token"]);

    $response->assertStatus(200);
    $response->assertViewHas('breweries', function ($breweries) {
        return $breweries[0]['name'] === '(405) Brewing Co';
    });
});

it('retrieves correctly first result of second page of breweries', function () {
    User::create([
        'name' => 'root',
        'email' => 'root@succ.ess',
        'password' => Hash::make('password'),
    ]);

    $this->post('/login', [
        'name' => 'root',
        'password' => 'password'
    ]);

    $token = session('token');

    $response = $this->get('/breweries?page=2', ['Authorization' => "Bearer $token"]);

    $response->assertStatus(200);
    $response->assertViewHas('breweries', function ($breweries) {
        return $breweries[0]['name'] === '12 Gates Brewing Company';
    });
});

it('fails if route is not authenticated', function () {
    $response = $this->get('/breweries');

    expect($response->exception->getMessage())->toBe('Unauthenticated.');
});
