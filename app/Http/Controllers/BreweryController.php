<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BreweryController extends Controller
{
    public function index(Request $request)
    {
        $token = session('token');
        if (!$token) {
            return redirect('/');
        }

        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 20);

        $response = Http::get('https://api.openbrewerydb.org/v1/breweries', [
            'page' => $page,
            'per_page' => $perPage
        ]);

        $breweries = $response->json();

        return view('breweries', compact('breweries', 'page'));
    }
}
