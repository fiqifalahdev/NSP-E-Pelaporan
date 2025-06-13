<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request)
  {
    // Validate the request data
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'role' => 'required|string|in:admin,user', // nanti tambah role untuk validasinya
    ]);

    // Create a new user
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => $request->role,
    ]);

    if (!$user) {
      return redirect()->back()->withErrors(['error' => 'Failed to create user.']);
    }

    // ✅ Login pakai facade Auth
    Auth::login($user);

    // Redirect to the intended page
    return redirect()->route('dashboard');
  }
}
