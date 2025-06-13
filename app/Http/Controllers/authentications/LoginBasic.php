<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  /**
   * Handle an authentication attempt.
   */
  public function authenticate(Request $request): RedirectResponse
  {
    $credentials = $request->validate([
      'name' => ['required'],
      'password' => ['required'],
    ]);

    if (!$credentials) {
      return redirect()->back()->withErrors(['error' => 'Invalid credentials.']);
    }

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->route('dashboard');
    }

    return back()->withErrors([
      'name' => 'The provided credentials do not match our records.',
    ])->onlyInput('name');
  }

  /**
   * Logout the user.
   *
   * 
   */
  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')->with('success', 'Logout successful');
  }
}
