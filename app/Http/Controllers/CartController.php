<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->is_active) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('cart', compact('items', 'total'));
    }

    /**
     * Add to cart
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'integer|min:1|max:99',
        ]);

        if (!$product->is_active || !$product->inStock()) {
            return back()->with('error', 'Produk tidak tersedia.');
        }

        $quantity = $request->get('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        // Check stock
        if ($cart[$product->id] > $product->stock) {
            $cart[$product->id] = $product->stock;
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    /**
     * Update cart quantity
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $cart = session()->get('cart', []);
        $quantity = $request->quantity;

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            // Check stock
            if ($quantity > $product->stock) {
                $quantity = $product->stock;
            }
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Keranjang diperbarui!');
    }

    /**
     * Remove from cart
     */
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang!');
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan!');
    }
}
