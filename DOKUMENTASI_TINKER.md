# Dokumentasi 5 Query Tinker

Jalankan `php artisan tinker`, ketik query, lalu **screenshot** hasilnya dan tempel di bawah tiap nomor.

## 1. Produk aktif dan tersedia, termahal 5 teratas (scope + eager loading)
```php
App\Models\Product::with('category')->active()->inStock()->orderByDesc('price')->take(5)->get(['id','name','price','category_id']);
```
Screenshot: (tempel)

## 2. Jumlah produk per kategori (withCount)
```php
App\Models\Category::withCount('products')->get(['id','name']);
```
Screenshot: (tempel)

## 3. Satu pesanan lengkap dengan pembeli dan item produknya (relasi bersarang)
```php
App\Models\Order::with('user','items.product')->first();
```
Screenshot: (tempel)

## 4. Tiga produk dengan rating rata-rata tertinggi (aggregate + groupBy)
```php
App\Models\Review::selectRaw('product_id, avg(rating) as rata_rata, count(*) as jumlah')->groupBy('product_id')->orderByDesc('rata_rata')->limit(3)->get();
```
Screenshot: (tempel)

## 5. Editor beserta jumlah produk yang dibuatnya (where + withCount)
```php
App\Models\User::where('role','editor')->withCount('products')->get(['id','name','role']);
```
Screenshot: (tempel)

## Bonus: demo eager loading (hindari N+1)
```php
// Tanpa eager loading: 1 query + 1 query per produk
App\Models\Product::take(10)->get()->each(fn($p) => $p->category->name);

// Dengan eager loading: hanya 2 query
App\Models\Product::with('category')->take(10)->get()->each(fn($p) => $p->category->name);
```
Untuk melihat jumlah query, jalankan di tinker: `DB::enableQueryLog();` sebelum query dan `count(DB::getQueryLog());` sesudahnya.
