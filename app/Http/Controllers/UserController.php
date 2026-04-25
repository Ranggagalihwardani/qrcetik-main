<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $users = User::when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.users', compact('users', 'q'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return back()->with('success', 'Role berhasil diubah');
    }

    public function destroy(User $user)
    {
        // cegah admin hapus diri sendiri
        if (auth()->id() === $user->id) {
            return back()->withErrors('Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}