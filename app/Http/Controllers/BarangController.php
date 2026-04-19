<?php
namespace App\Http\Controllers;

use Inertia\Inertia;

class BarangController extends Controller
{
    public function index()
    {
        $data = [
            ['nama' => 'Laptop', 'stok' => 10],
            ['nama' => 'Mouse', 'stok' => 50],
        ];

        return Inertia::render('Barang/Index', [
            'barang' => $data
        ]);
    }
}