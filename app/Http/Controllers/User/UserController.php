<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert; 
class UserController extends Controller
{
    public function index()
    {
        $products = Product ::all();

        return view('pages.user.index', compact('products'));
    }

    public function detail_product($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.user.detail', compact('product'));
    }

    public function purchase($productId, $userId)
    {
        $product = Product::findOrFail($productId);
        $user = User::findOrFail($userId);

        if ($user->point >> $product->price) {
            $totalPoints = $user->point - $product->price;

            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil', 'Produk berhasil di beli!');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Poin anda tidak cukup!');
            return redirect()->back();
        }
    }

    public function flashsale()
    {
        // Ambil semua produk flash sale
        $products = DB::table('products')
            ->where('is_flash_sale', true)
            ->get();

        // Ambil poin pengguna
        $userPoints = auth()->user()->points ?? 0;

        // Hitung diskon untuk setiap produk
        foreach ($products as $product) {
            $originalPrice = $product->discount_price ?? $product->price; // Gunakan harga diskon jika ada
            $product->discounted_price = $this->calculateDiscountPrice($originalPrice, $userPoints);
        }

        // Return ke view flashsale
        return view('pages.user.flashsale', compact('products', 'userPoints'));
    }

    private function calculateDiscountPrice($price, $points)
    {
        $discountPerPoint = 10000; // Diskon per poin
        $discountAmount = floor($points / $discountPerPoint) * $discountPerPoint;

        // Pastikan harga tidak negatif
        return max(0, $price - $discountAmount);
    }

}
