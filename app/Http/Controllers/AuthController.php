<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/forum')->with('welcome_status', 'new');
    }

    public function showLogin() { return view('auth.login'); }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Force session to "back" so the typewriter says "Welcome back..."
            return redirect('/forum')->with('welcome_status', 'back');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    //  It is the Confirmation Page
    public function showDeleteConfirm() {
        return view('auth.confirm-delete');
    }

    // It Deletes With Password Checking
    public function deleteAccount(Request $request) {
        $request->validate([
            'password' => 'required'
        ]);

        $user = User::find(Auth::id());


        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password. Account was NOT deleted.']);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
