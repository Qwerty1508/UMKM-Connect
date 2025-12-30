<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Show CMS configuration form
     */
    public function edit()
    {
        $configs = Config::getAllAsArray();
        
        // Default values
        $defaults = [
            'business_name' => 'UMKM Universal',
            'tagline' => 'Kualitas Terbaik untuk Anda',
            'primary_color' => '#1a1a2e',
            'secondary_color' => '#c9a227',
            'accent_color' => '#f5f5f5',
            'hero_image_url' => '',
            'logo_url' => '',
            'about_text' => '',
            'contact_phone' => '',
            'contact_email' => '',
            'contact_address' => '',
            'instagram_url' => '',
            'facebook_url' => '',
            'whatsapp_number' => '',
        ];

        $config = array_merge($defaults, $configs);

        return view('admin.config.edit', compact('config'));
    }

    /**
     * Update CMS configuration
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:50',
            'tagline' => 'nullable|string|max:50',
            'primary_color' => 'required|string|max:20',
            'secondary_color' => 'required|string|max:20',
            'accent_color' => 'required|string|max:20',
            'hero_image_url' => 'nullable|url|max:500',
            'logo_url' => 'nullable|url|max:500',
            'about_text' => 'nullable|string|max:1000',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:100',
            'contact_address' => 'nullable|string|max:200',
            'instagram_url' => 'nullable|url|max:200',
            'facebook_url' => 'nullable|url|max:200',
            'whatsapp_number' => 'nullable|string|max:20',
        ]);

        foreach ($validated as $key => $value) {
            Config::set($key, $value);
        }

        return redirect()->route('admin.config.edit')
            ->with('success', 'Konfigurasi berhasil disimpan!');
    }
}
