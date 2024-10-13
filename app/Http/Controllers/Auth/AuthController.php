<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Pastikan semua email dan password terisi dengan benar!');
            return redirect()->back();
        }

        // Check for admin login attempt
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            toast('Selamat datang admin!', 'success');
            return redirect()->route('admin.dashboard');
        } 
        // Check for regular user login attempt
        elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            toast('Selamat datang!', 'success');
            return redirect()->route('user.dashboard');
        } 
        // Login failed
        else {
            Alert::error('Login Gagal!', 'Email atau password tidak valid!');
            return redirect()->back();
        }
    }

    // Admin logout function
    public function admin_logout() 
    {
        Auth::guard('admin')->logout();
        toast('Berhasil logout!', 'success');
        return redirect('/');
    }

    // User logout function
    public function user_logout() 
    {
        Auth::logout();
        toast('Berhasil logout!', 'success');
        return redirect('/');
    }
    public function register()
    {
    return view('register');
    }

    public function post_register(Request $request)
    {
    // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
        // Jika validasi gagal, tampilkan pesan error dan arahkan kembali
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

    // Simpan data pengguna ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'point' => 10000,
        ]);
    // Cek apakah pembuatan user berhasil
        if ($user) {
        // Jika berhasil, tampilkan pesan sukses dan arahkan ke halaman login
            Alert::success('Berhasil!', 'Akun baru berhasil dibuat, silakan melakukan login!');
            return redirect('/');
        } else {
        // Jika gagal, tampilkan pesan error dan arahkan kembali
            Alert::error('Gagal!', 'Akun gagal dibuat, silakan coba lagi');
            return redirect()->back();
        }
    }
}

    