<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('content.users.index', compact('users'));
    }

    public function create()
    {
        $generatedPassword = Str::random(10);
        return view('content.users.create', compact('generatedPassword'));
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|in:admin,user,supervisor,manager',
            ]);

            if (!$validatedData) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }

            $password = $request->generated_password ?? Str::random(10);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($password),
            ]);

            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('content.users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('content.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,user,supervisor,manager',
        ]);

        // Check if the request reset password is not empty
        if ($request->has('reset_password') && $request->reset_password) {
            $password = Str::random(10);
            $user->password = Hash::make($password);

            // Simpan dulu perubahan sebelum return
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();

            return redirect()
                ->route('users.edit', $user->id)
                ->with([
                    'success' => 'User updated successfully.',
                    'new_password' => $password
                ]);
        } else {
            // If password is not reset, do not change the password
            $request->validate([
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()
            ->route('users.edit', $user->id)
            ->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
