# TugasWeb-P11-EcommerceAuth

Tugas Rutin 11: E-Commerce Database + Secure Auth (Laravel).

## Cara Install
1. `composer install`
2. `npm install` lalu `npm run build`
3. Salin `.env.example` menjadi `.env`, lalu atur database:
```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tugasweb_p11
   DB_USERNAME=root
   DB_PASSWORD=
```
4. Buat database `tugasweb_p11` di phpMyAdmin
5. `php artisan key:generate`
6. `php artisan migrate --seed`
7. `php artisan serve`, lalu buka http://127.0.0.1:8000

## Akun Percobaan
| Role | Email | Password |
|------|-------|----------|
| admin | admin@example.com | password |
| editor | editor@example.com | password |
| user | user@example.com | password |

## Bagian A: Database & Eloquent
- 7 tabel e-commerce dengan foreign key: categories, products, orders, order_items, reviews, addresses, wishlists
- Seeder dan factory: 6 kategori, 54 produk
- Model dengan relationships dan scope `active`, `inStock`, `search` pada `Product`
- 5 query Tinker: lihat folder `docs/`

## Bagian B: Auth & Security
- Autentikasi Laravel Breeze (login, register, logout)
- Multi-role `admin`, `editor`, `user` dengan middleware `CheckRole` (alias `role`)
- `PostPolicy` untuk otorisasi edit dan hapus post:
  - admin: boleh semua
  - editor: boleh membuat dan mengedit post miliknya sendiri
  - user: hanya melihat
- Route protection:
  - `/admin` hanya untuk admin (role lain mendapat 403)
  - `/products` kelola hanya untuk admin dan editor
  - `/posts` wajib login
- Testing incognito 2 role (admin dan user): lihat folder `docs/`