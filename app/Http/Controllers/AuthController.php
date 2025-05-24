<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Cek role dan redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'pembimbing') {
            // redirect ke dashboard pembimbing
            return redirect()->route('pembimbing.dashboard');
        } elseif ($user->role === 'mahasiswa') {
            // redirect ke dashboard mahasiswa
            return redirect()->route('mahasiswa.dashboard');
        }

        // Default redirect kalau role tidak dikenali
        return redirect('/');
    }

    // Jika gagal login
    return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
}


        public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,dosen,mahasiswa', // sesuaikan role
        ]);

        try {
    \App\Models\User::create([
        'username' => $request->username,
        'password' => $request->password,
        'role' => $request->role,
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
} catch (\Exception $e) {
    return back()->withErrors(['register' => 'Gagal menyimpan data: ' . $e->getMessage()]);
}

    }

}
