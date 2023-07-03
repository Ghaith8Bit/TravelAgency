<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authentication()
    {
        return view('auth.pages.authentication');
    }

    public function signin(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput()->with('toastify', [
                'text' => 'The provided credentials do not match our records.',
                'className' => 'error',
            ]);
        }
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.home')->with('toastify', [
                'text' => 'You have been successfully signed in.',
                'className' => 'success',
            ]);
        }
        return redirect()->route('auth.authentication')->with('toastify', [
            'text' => 'The provided credentials do not match our records.',
            'className' => 'error',
        ]);
    }

    public function signup(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->errors())->withInput()->with('toastify', [
                'text' => 'The data you provide has errors.',
                'className' => 'error',
            ]);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard.home')->with('toastify', [
            'text' => 'Your account has been created successfully.',
            'className' => 'success',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('website.home')->with('toastify', [
            'text' => 'You have been successfully logged out.',
            'className' => 'success',
        ]);
    }
}
