<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OPD;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function cekAdminSistem()
    {
        if (!session('user')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu')->send();
            exit;
        }

        if (session('user')->role !== 'admin_sistem') {
            return redirect('/')->with('error', 'Akses ditolak')->send();
            exit;
        }
    }

    public function index()
    {
        $this->cekAdminSistem();
        $users = User::all();
        return view('admin_sistem.user.index', compact('users'));
    }

    public function create()
    {
        $this->cekAdminSistem();
        $opd = OPD::all();
        return view('admin_sistem.user.create', compact('opd'));
    }

    public function store(Request $request)
    {
        $this->cekAdminSistem();

        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'role' => 'required',
            'id_opd' => 'required_if:role,admin_opd|nullable|exists:opd,id_opd',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'id_opd' => $request->role == 'admin_opd' ? $request->id_opd : null,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $this->cekAdminSistem();
        $user = User::findOrFail($id);
        $opd = OPD::all();
        return view('admin_sistem.user.edit', compact('user', 'opd'));
    }

    public function update(Request $request, $id)
    {
        $this->cekAdminSistem();
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required',
            'id_opd' => 'required_if:role,admin_opd|nullable|exists:opd,id_opd',
        ]);

        $data = [
            'username' => $request->username,
            'role' => $request->role,
            'id_opd' => $request->role == 'admin_opd' ? $request->id_opd : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $this->cekAdminSistem();
        $user = User::findOrFail($id);

        if (session('user')->id == $id) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

    public function show($id)
    {
        $this->cekAdminSistem();
        $user = User::findOrFail($id);
        return view('admin_sistem.user.show', compact('user'));
    }
}