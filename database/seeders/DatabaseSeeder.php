<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Config;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin
        Admin::create([
            'email' => 'admin@example.com',
            'name' => 'Admin',
        ]);

        // Create default configs with placeholder images
        $configs = [
            'business_name' => 'UMKM Universal',
            'tagline' => 'Kualitas Terbaik untuk Anda',
            'primary_color' => '#1a1a2e',
            'secondary_color' => '#c9a227',
            'accent_color' => '#f5f5f5',
            'about_text' => 'Kami adalah UMKM yang berkomitmen menyediakan produk berkualitas tinggi dengan harga terjangkau. Setiap produk dibuat dengan penuh dedikasi dan cinta untuk memberikan pengalaman terbaik bagi pelanggan kami.',
            'contact_phone' => '+62 812 3456 7890',
            'contact_email' => 'hello@umkm-universal.com',
            'contact_address' => 'Jl. Contoh No. 123, Jakarta',
            'whatsapp_number' => '6281234567890',
            'hero_image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1920&q=80',
            'logo_url' => '',
            'instagram_url' => 'https://instagram.com',
            'facebook_url' => 'https://facebook.com',
        ];

        foreach ($configs as $key => $value) {
            Config::create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        // Create sample products with Unsplash images
        $products = [
            [
                'name' => 'Produk Premium A',
                'price' => 150000,
                'description' => 'Produk berkualitas tinggi dengan bahan premium pilihan. Dibuat dengan tangan oleh pengrajin berpengalaman untuk memberikan hasil terbaik.',
                'image_path' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Eksklusif B',
                'price' => 250000,
                'description' => 'Produk eksklusif edisi terbatas dengan desain elegan. Sempurna untuk hadiah atau koleksi pribadi.',
                'image_path' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Spesial C',
                'price' => 175000,
                'description' => 'Produk spesial dengan fitur unggulan dan kualitas terjamin. Cocok untuk penggunaan sehari-hari.',
                'image_path' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=800&q=80',
                'stock' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Favorit D',
                'price' => 99000,
                'description' => 'Produk favorit pelanggan dengan harga terjangkau. Best seller bulan ini!',
                'image_path' => 'https://images.unsplash.com/photo-1560343090-f0409e92791a?w=800&q=80',
                'stock' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Handmade E',
                'price' => 185000,
                'description' => 'Produk handmade dengan sentuhan artistik. Setiap item unik dan satu-satunya.',
                'image_path' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=800&q=80',
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Produk Natural F',
                'price' => 125000,
                'description' => 'Produk berbahan alami tanpa bahan kimia berbahaya. Ramah lingkungan dan aman digunakan.',
                'image_path' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=800&q=80',
                'stock' => 60,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
