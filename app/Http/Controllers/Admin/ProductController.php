<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        confirmDelete('Hapus Data!'. 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.product.index', compact('products'));
    }
    public function create()
    {
        $products = Product::all();

        return view('pages.admin.product.create');
    }
    public function detail($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.admin.product.detail', compact('product'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.admin.product.edit', compact('product'));
    }
    public function delete($id)
{
    $product = Product::findOrFail($id);

    $oldPath = public_path('images/' . $product->image);
    if (File::exists($oldPath)) {
        File::delete($oldPath);
    }

    $product->delete();

    if ($product) {
        Alert::success('Berhasil!', 'Produk berhasil dihapus!');
        return redirect()->back();
    } else {
        Alert::error('Gagal!', 'Produk gagal dihapus!');
        return redirect()->back();
    }
}
    public function update(Request $request, $id)
{
    // Validasi input dari form
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'numeric',
        'discount_price' => 'nullable|numeric',
        'category' => 'required',
        'description' => 'required',
        'image' => 'nullable|mimes:png,jpeg,jpg',
    ]);

    if ($validator->fails()) {
        Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
        return redirect()->back();
    }

    // Temukan produk berdasarkan ID
    $product = Product::findOrFail($id);

    // Jika ada gambar baru yang diunggah, hapus gambar lama jika ada
    if ($request->hasFile('image')) {
        $oldPath = public_path('images/' . $product->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Simpan gambar baru
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/', $imageName);
    } else {
        // Jika tidak ada gambar baru, gunakan nama gambar yang lama
        $imageName = $product->image;
    }

    // Update data produk
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
        'category' => $request->category,
        'description' => $request->description,
        'image' => $imageName,
    ]);

    // Tampilkan pesan sukses atau gagal dan redirect
    if ($product) {
        Alert::success('Berhasil!', 'Produk berhasil diperbarui!');
        return redirect()->route('admin.product');
    } else {
        Alert::error('Gagal!', 'Produk gagal diperbarui!');
        return redirect()->back();
    }
}
    public function store(Request $request)
    {
    // Validasi input dari form
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'numeric',
        'discount_price' => 'nullable|numeric',
        'category' => 'required',
        'description' => 'required',
        'image' => 'required|mimes:png,jpeg,jpg',
    ]);

    // Jika validasi gagal, tampilkan pesan error dan arahkan kembali ke halaman sebelumnya
    if ($validator->fails()) {
        Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
        return redirect()->back();
    }

    // Jika ada file gambar yang diunggah
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/', $imageName);
    }

    // Simpan data produk ke database
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
        'category' => $request->category,
        'description' => $request->description,
        'image' => $imageName,
    ]);

    // Jika data produk berhasil disimpan, tampilkan pesan sukses dan arahkan ke halaman produk
    if ($product) {
        Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
        return redirect()->route('admin.product');
    } else {
        // Jika gagal, tampilkan pesan error dan arahkan kembali ke halaman sebelumnya
        Alert::error('Gagal!', 'Produk gagal ditambahkan!');
        return redirect()->back();
    }
    
}
    
}