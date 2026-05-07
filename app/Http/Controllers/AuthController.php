<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OPD;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string',
        ]);

        $username = trim($request->username);
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Username atau password salah');
        }

        $passwordHash = $user->password;
        $check = false;

        if (is_string($passwordHash) && preg_match('/^\$2[ayb]\$/', $passwordHash)) {
            $check = Hash::check($password, $passwordHash);
        } elseif ($passwordHash !== null && $passwordHash === $password) {
            $check = true;
            $user->password = Hash::make($password);
            $user->save();
        }

        if (!$check) {
            return back()->withInput()->with('error', 'Username atau password salah');
        }

        session(['user' => $user]);

        if ($user->role == 'admin_sistem') {
            return redirect('/dashboard/admin_sistem')->with('success', 'Login berhasil!');
        } elseif ($user->role == 'admin_opd') {
            return redirect('/dashboard/admin_opd')->with('success', 'Login berhasil!');
        } elseif ($user->role == 'verifikator') {
            return redirect('/dashboard/verifikator')->with('success', 'Login berhasil!');
        } elseif ($user->role == 'admin_administrasi') {
            return redirect('/dashboard/admin_administrasi')->with('success', 'Login berhasil!');
        }

        return redirect('/dashboard/admin_opd')->with('success', 'Login berhasil!');
    }

    public function dashboardAdminSistem()
    {
        if (!session('user')) return redirect('/');
        $user = session('user');
        return view('dashboard.admin_sistem', compact('user'));
    }

    public function dashboardAdminOPD()
    {
        if (!session('user')) return redirect('/');
        $user = session('user');
        return view('dashboard.admin_opd', compact('user'));
    }

    public function dashboardVerifikator()
    {
        if (!session('user')) return redirect('/');
        $user = session('user');
        return view('dashboard.verifikator', compact('user'));
    }

    public function dashboardAdminAdministrasi()
    {
        if (!session('user')) return redirect('/');
        $user = session('user');
        return view('dashboard.admin_administrasi', compact('user'));
    }

    public function showRegister()
    {
        if (!session('user')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = session('user');

        if ($user->role !== 'admin_sistem') {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        $opd = OPD::all();
        return view('register', compact('opd'));
    }

    public function register(Request $request)
    {
        if (!session('user')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = session('user');

        if ($user->role !== 'admin_sistem') {
            return redirect('/')->with('error', 'Akses ditolak');
        }

        $request->validate([
            'username' => 'required|string|max:100|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
            'id_opd' => 'required_if:role,admin_opd|nullable',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'id_opd' => $request->id_opd,
        ]);

        return redirect('/register')->with('success', 'Registrasi user berhasil!');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('/');
    }
}