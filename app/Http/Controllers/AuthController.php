<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $apiBaseUrl = 'http://localhost:8080/'; // Ganti dengan URL API CI kamu

    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Session::has('user')) {
            return $this->redirectByRole();
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            // Kirim request ke API CI
            $response = Http::post($this->apiBaseUrl . '/auth/login', [
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $responseData = $response->json();

            if ($response->successful() && $responseData['status'] === 'success') {
                $userData = $responseData['data'];
                
                // Simpan data user di session
                Session::put('user', [
                    'id_user' => $userData['id_user'],
                    'username' => $userData['username'],
                    'role' => $userData['role'],
                    'token' => $userData['token']
                ]);

                // Redirect berdasarkan role
                return $this->redirectByRole();
            } else {
                return back()->withErrors(['login' => $responseData['message'] ?? 'Login gagal'])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['login' => 'Terjadi kesalahan koneksi ke server: ' . $e->getMessage()])->withInput();
        }
    }

    public function showRegisterForm()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (Session::has('user')) {
            return $this->redirectByRole();
        }
        
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,mahasiswa,pembimbing',
        ]);

        try {
            // Kirim request ke API CI
            $response = Http::post($this->apiBaseUrl . '/auth/register', [
                'username' => $request->username,
                'password' => $request->password,
                'role' => $request->role,
            ]);

            $responseData = $response->json();

            if ($response->successful() && $responseData['status'] === 'success') {
                return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                return back()->withErrors(['register' => $responseData['message'] ?? 'Registrasi gagal'])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['register' => 'Terjadi kesalahan koneksi ke server: ' . $e->getMessage()])->withInput();
        }
    }

    public function logout()
    {
        Session::forget('user');
        Session::flush();
        
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    // Helper method untuk redirect berdasarkan role
    private function redirectByRole()
    {
        $userRole = Session::get('user.role');
        
        switch ($userRole) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            case 'pembimbing':
                return redirect()->route('pembimbing.dashboard');
            default:
                // Jika role tidak dikenali, logout dan redirect ke login
                Session::forget('user');
                return redirect()->route('login')->withErrors(['login' => 'Role tidak valid']);
        }
    }

    // Helper method untuk cek apakah user sudah login (bisa dipanggil di controller lain)
    public static function checkAuth()
    {
        return Session::has('user');
    }

    // Helper method untuk cek role (bisa dipanggil di controller lain)
    public static function checkRole($allowedRoles)
    {
        if (!self::checkAuth()) {
            return false;
        }

        $userRole = Session::get('user.role');
        
        if (is_string($allowedRoles)) {
            $allowedRoles = [$allowedRoles];
        }
        
        return in_array($userRole, $allowedRoles);
    }

    // Helper method untuk mendapatkan user data dari session
    public static function getUser()
    {
        return Session::get('user');
    }
}