<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $status = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];

        foreach (User::where('role', 'user')->get() as $pembeli) {
            $alamat = Address::create([
                'user_id'     => $pembeli->id,
                'label'       => 'Rumah',
                'recipient'   => $pembeli->name,
                'phone'       => '08' . fake()->numerify('##########'),
                'street'      => 'Jl. Merdeka No. ' . fake()->numberBetween(1, 99),
                'city'        => 'Medan',
                'postal_code' => '20' . fake()->numerify('###'),
            ]);

            for ($i = 0; $i < 3; $i++) {
                $order = Order::create([
                    'user_id'      => $pembeli->id,
                    'address_id'   => $alamat->id,
                    'order_number' => 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                    'status'       => fake()->randomElement($status),
                    'total'        => 0,
                ]);

                $total = 0;
                foreach (Product::active()->inRandomOrder()->take(random_int(1, 3))->get() as $produk) {
                    $qty = random_int(1, 3);
                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $produk->id,
                        'quantity'   => $qty,
                        'price'      => $produk->price,
                    ]);
                    $total += $produk->price * $qty;
                }
                $order->update(['total' => $total]);
            }

            // Beberapa review dari tiap pembeli (1 review per produk)
            foreach (Product::inRandomOrder()->take(5)->get() as $produk) {
                Review::create([
                    'user_id'    => $pembeli->id,
                    'product_id' => $produk->id,
                    'rating'     => random_int(3, 5),
                    'comment'    => fake()->randomElement([
                        'Barang sesuai deskripsi, pengiriman cepat.',
                        'Kualitas bagus untuk harganya.',
                        'Packing rapi, recommended.',
                        'Cukup puas, akan beli lagi.',
                    ]),
                ]);
            }
        }
    }
}
