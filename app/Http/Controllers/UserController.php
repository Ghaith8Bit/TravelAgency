<?php

namespace App\Http\Controllers;

use App\Filters\UserFilters;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = (new UserFilters($request))->get();

        return view('dashboard.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);

        $message = app()->getLocale() === 'ar' ? 'تم إنشاء المستخدم بنجاح.' : 'User created successfully.';

        return redirect()->route('dashboard.users.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->input('name') ?? $user->name,
            'email' => $request->input('email') ?? $user->email,
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
        ]);

        $message = app()->getLocale() === 'ar' ? 'تم تحديث المستخدم بنجاح.' : 'User updated successfully.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        $message = app()->getLocale() === 'ar' ? 'تم حذف المستخدم بنجاح.' : 'User deleted successfully.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Update the role for the specified resource in storage.
     */
    public function role(User $user)
    {
        if ($user->email == 'admin@hotelier.com') {
            $message = app()->getLocale() === 'ar' ? 'لا يمكن تحويل هذا المشرف إلى مستخدم.' : 'This Admin can not be User';
            return redirect()->back()->with('error', $message);
        } else {
            $user->update([
                'role_id' => $user->role_id == 1 ? 2 : 1,
            ]);
            $message = app()->getLocale() === 'ar' ? 'تم تغيير دور المستخدم بنجاح.' : 'User role changed successfully.';
            return redirect()->back()->with('success', $message);
        }
    }
}
