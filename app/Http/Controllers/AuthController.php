<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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

    public function showEmailForm()
    {
        return view('auth.pages.reset');
    }


    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate a unique token
        $token = Str::random(64);

        // Save the token and email in the database
        DB::table('password_reset_tokens')->upsert(
            ['email' => $request->email, 'token' => $token, 'created_at' => now()],
            ['email'],
            ['token' => $token, 'created_at' => now()]
        );


        // Generate the reset link
        $resetLink = URL::route('auth.reset.form', ['token' => $token]);

        // Send the reset link via email
        Mail::to($request->email)->send(new ResetPasswordMail($resetLink));

        return redirect()->back();
    }

    public function showResetForm($token)
    {
        $email = DB::table('password_reset_tokens')->where('token', $token)->pluck('email')->first();
        if (!$email) {
            return redirect()->route('auth.authentication')->with('toastify', [
                'text' => 'Invalid token.',
                'className' => 'error',
            ]);
        }
        return view('auth.pages.password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $email = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->pluck('email')
            ->first();

        if (!$email) {
            return redirect()->route('auth.authentication')->with('toastify', [
                'text' => 'Invalid token.',
                'className' => 'error',
            ]);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('auth.authentication')->with('toastify', [
                'text' => 'User not found.',
                'className' => 'error',
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        return redirect()->route('auth.authentication')->with('toastify', [
            'text' => 'Password reset successfully.',
            'className' => 'success',
        ]);
    }

}
