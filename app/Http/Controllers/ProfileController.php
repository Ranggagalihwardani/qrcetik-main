<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil.
     */
    public function edit()
    {
        return view('profile');
    }

    /**
     * Update foto profil (avatar).
     */
    public function updateAvatar(Request $request)
    {
        // Validasi file gambar
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        if (! $request->hasFile('avatar')) {
            return back()->withErrors(['avatar' => 'File avatar tidak ditemukan.']);
        }

        $file = $request->file('avatar');

        // Simpan ke storage/app/public/avatars dengan nama unik
        $filename = uniqid('ava_') . '.' . $file->getClientOriginalExtension();
        $path     = $file->storeAs('avatars', $filename, 'public'); // -> 'avatars/ava_xxx.ext'

        // Hapus avatar lama jika ada & file-nya masih exist
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Update kolom avatar di tabel users
        $user->avatar = $path;                   // simpan relatif: avatars/ava_xxx.jpg
        $user->save();

        return back()->with('ok', 'Foto profil berhasil diperbarui!');
    }
}
