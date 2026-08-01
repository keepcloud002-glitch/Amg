<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tampilkan daftar semua user
    public function index()
    {
        // Proteksi: Hanya admin yang boleh akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak: Hanya Admin yang dapat mengakses halaman ini!');
        }

        $users = User::all();
        return view('users', compact('users'));
    }

    // Update role user
    public function updateRole(Request $request, $id)
    {
        // Proteksi: Hanya admin yang boleh ubah role
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }

        $user = User::findOrFail($id);
        
        // Mencegah Admin mengubah rolenya sendiri menjadi kasir (biar tidak terkunci keluar)
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri!');
        }

        $request->validate([
            'role' => 'required|in:admin,kasir',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role user berhasil diperbarui!');
    }
}
