<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;


class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::count();
        $users = User::count();

        return view('pages.admin.index', compact('products', 'users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|lt:price', // Pastikan diskon lebih kecil dari harga asli
        // validation lainnya
    ]);

    // Simpan produk
    $product = new Product();
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->discount_price = $request->input('discount_price');
    // Simpan atribut lainnya
    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
}
}