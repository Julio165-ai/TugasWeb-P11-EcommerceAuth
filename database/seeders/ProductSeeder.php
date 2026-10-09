<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $penjual = User::whereIn('role', ['admin', 'editor'])->pluck('id');

        // [nama produk, harga dalam Rupiah]
        $katalog = [
            'Elektronik' => [
                ['Earbuds Bluetooth TWS ANC', 189000],
                ['Power Bank 10000 mAh Fast Charging', 159000],
                ['Mouse Wireless Silent Click', 85000],
                ['Keyboard Mekanikal 60% Hot-Swap', 449000],
                ['Webcam Full HD 1080p', 275000],
                ['Flashdisk 64GB USB 3.2', 79000],
                ['Speaker Bluetooth Portable Waterproof', 225000],
                ['Charger GaN 65W 3 Port', 249000],
                ['Smartwatch Layar AMOLED 1.43 inci', 599000],
            ],
            'Fashion Pria' => [
                ['Kaos Polos Cotton Combed 30s', 65000],
                ['Kemeja Flanel Lengan Panjang', 145000],
                ['Celana Chino Slim Fit', 189000],
                ['Jaket Hoodie Fleece Oversize', 175000],
                ['Celana Jogger Training', 119000],
                ['Sepatu Sneakers Casual Canvas', 235000],
                ['Topi Baseball Bordir', 49000],
                ['Ikat Pinggang Kulit Sintetis', 75000],
                ['Kaos Kaki Sport Ankle (3 Pasang)', 39000],
            ],
            'Fashion Wanita' => [
                ['Blouse Linen Lengan Balon', 129000],
                ['Rok Plisket Panjang', 99000],
                ['Hijab Voal Ultrafine Segi Empat', 59000],
                ['Gamis Katun Rayon Polos', 215000],
                ['Tas Selempang Mini Sling Bag', 135000],
                ['Kardigan Rajut Oversize', 125000],
                ['Celana Kulot Highwaist', 105000],
                ['Dress Midi Motif Bunga', 169000],
                ['Sandal Wedges Tali Ankle', 149000],
            ],
            'Peralatan Rumah' => [
                ['Rice Cooker Digital 1.8 Liter', 329000],
                ['Set Panci Anti Lengket 5 Pcs', 275000],
                ['Blender Portable USB', 119000],
                ['Dispenser Air Galon Atas', 289000],
                ['Lampu LED Meja Dimmable', 89000],
                ['Set Pisau Dapur Stainless 6 Pcs', 149000],
                ['Kipas Angin Berdiri 16 inci', 379000],
                ['Rak Sepatu Susun 4 Tingkat', 135000],
                ['Setrika Uap Genggam', 199000],
            ],
            'Olahraga' => [
                ['Matras Yoga TPE 6mm', 125000],
                ['Dumbbell Set Adjustable 10 Kg', 289000],
                ['Botol Minum Sport 1 Liter', 55000],
                ['Tali Skipping Speed Bearing', 45000],
                ['Sepatu Lari Ringan Mesh', 359000],
                ['Resistance Band Set 5 Level', 69000],
                ['Tas Gym Duffel Waterproof', 169000],
                ['Sarung Tangan Gym Anti Slip', 59000],
                ['Raket Badminton Carbon Set 2 Pcs', 275000],
            ],
            'Buku & Alat Tulis' => [
                ['Notebook A5 Hardcover Dotted 150 Halaman', 42000],
                ['Pulpen Gel 0.5 mm (Isi 12)', 36000],
                ['Highlighter Pastel Set 6 Warna', 29000],
                ['Kalkulator Ilmiah 240 Fungsi', 135000],
                ['Binder Clip Campur (Isi 60 Pcs)', 19000],
                ['Planner Mingguan Undated', 55000],
                ['Map Plastik Dokumen Snap Button (Isi 10)', 27000],
                ['Lem Stick Non-Toxic (Isi 6)', 24000],
                ['Papan Jalan A4 Clipboard Akrilik', 32000],
            ],
        ];

        foreach ($katalog as $namaKategori => $produk) {
            $kategori = Category::where('name', $namaKategori)->firstOrFail();

            foreach ($produk as [$nama, $harga]) {
                Product::factory()->create([
                    'category_id' => $kategori->id,
                    'user_id'     => $penjual->random(),
                    'name'        => $nama,
                    'slug'        => Str::slug($nama),
                    'description' => "{$nama} kualitas terbaik, cocok untuk kebutuhan sehari-hari. Garansi toko 7 hari.",
                    'price'       => $harga,
                    'stock'       => fake()->numberBetween(5, 150),
                    'is_active'   => true,
                ]);
            }
        }
    }
}
