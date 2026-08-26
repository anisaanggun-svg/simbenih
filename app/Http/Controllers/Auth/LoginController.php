<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $info = 'Selamat datang di Sistem Informasi Perbenihan';
        $info2 = 'Silakan masuk dengan akun Anda';
        $link_daftar = '<a href="/register" class="text-center">Daftar akun baru</a>';
        $url_login = route('login.post');

        return view('login.login', compact('info', 'info2', 'link_daftar', 'url_login'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        return response()->json([
            'sukses' => true,
            'data' => [
                'token' => 'dev-token-' . time(),
                'user' => [
                    ['name' => $request->username],
                ],
            ],
            'url' => '/',
        ]);
    }
}
