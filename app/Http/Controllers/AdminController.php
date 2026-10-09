<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'jumlahUser'    => User::count(),
            'jumlahProduk'  => Product::count(),
            'jumlahPesanan' => Order::count(),
            'perRole'       => User::selectRaw('role, count(*) as total')->groupBy('role')->pluck('total', 'role'),
        ]);
    }
}
