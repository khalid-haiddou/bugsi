<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Show register form
    public function showRegisterForm()
    {
        // If already logged in, redirect
        if (Auth::check()) {
            return Auth::user()->role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('home');
        }
        
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted'
        ], [
            'name.required' => 'يرجى إدخال الاسم الكامل',
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'password.required' => 'يرجى إدخال كلمة المرور',
            'password.min' => 'كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'terms.accepted' => 'يجب الموافقة على الشروط والأحكام'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // Default role
        ]);

        // Login user
        Auth::login($user);

        // Return success
        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء الحساب بنجاح',
            'redirect' => route('home')
        ]);
    }
}