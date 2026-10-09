<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Elektronik', 'Fashion Pria', 'Fashion Wanita',
            'Peralatan Rumah', 'Olahraga', 'Buku & Alat Tulis',
        ];

        foreach ($kategori as $nama) {
            Category::create(['name' => $nama, 'slug' => Str::slug($nama)]);
        }
    }
}
