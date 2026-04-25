<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = [
            'site_name'     => Setting::get('site_name', 'CetakCetik'),
            'tagline'       => Setting::get('tagline', 'cetak PDF, cetik QR!'),
            'footer_text'   => Setting::get('footer_text', '© '.date('Y').' QR Docs'),
            'contact_email' => Setting::get('contact_email', 'support@example.com'),
            'company_name'  => Setting::get('company_name', 'QR Docs'),
            'company_addr'  => Setting::get('company_addr', '—'),
        ];

        return view('settings.edit', [
            'title'    => 'Pengaturan',
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name'     => 'required|string|max:255',
            'tagline'       => 'nullable|string|max:255',
            'footer_text'   => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'company_name'  => 'nullable|string|max:255',
            'company_addr'  => 'nullable|string|max:1000',
        ]);

        foreach ($data as $k => $v) {
            Setting::set($k, $v);
        }

        return back()->with('ok', 'Pengaturan berhasil disimpan.');
    }
}
