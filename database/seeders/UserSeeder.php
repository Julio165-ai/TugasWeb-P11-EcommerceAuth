<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun uji untuk 3 role. Password semuanya: password
        User::factory()->create(['name' => 'Admin Toko',  'email' => 'admin@example.com',  'role' => 'admin']);
        User::factory()->create(['name' => 'Editor Toko', 'email' => 'editor@example.com', 'role' => 'editor']);
        User::factory()->create(['name' => 'Pembeli',     'email' => 'user@example.com',   'role' => 'user']);

        // Pembeli tambahan (role default: user)
        User::factory()->count(5)->create();
    }
}
