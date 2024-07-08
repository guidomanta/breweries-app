<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        if (session()->has('token')) {
            return redirect()->route('breweries');
        }

        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = request(['name', 'password']);

        if (!auth()->attempt($credentials)) {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }

        $user = User::where('name', $request->name)->first();
        $token = $user->createToken('token')->plainTextToken;

        session(['token' => $token]);

        return redirect('breweries');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
