<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show landing page
     */
    public function index()
    {
        $config = Config::getAllAsArray();
        
        // Set default values
        $config = array_merge([
            'business_name' => 'UMKM Universal',
            'tagline' => 'Kualitas Terbaik untuk Anda',
            'primary_color' => '#1a1a2e',
            'secondary_color' => '#c9a227',
            'accent_color' => '#f5f5f5',
            'hero_image_url' => '',
        ], $config);

        $featuredProducts = Product::active()
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('config', 'featuredProducts'));
    }
}
