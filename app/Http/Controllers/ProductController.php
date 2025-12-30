<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //view untuk melihat produk
        $products = Product::all();
        return view('products.index', compact('products'));// mengembalikan view beserta variabel products

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // format array asosiatif diamana diambil dari kolom yang sudah didefinisikan di migration
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric|max:255',
            'deskripsi_produk' => 'required|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // apabula foto sesuai dengan yang disyaratkan di request->validate, maka dia taruh di public path
        if($request->hasFile('foto_produk')){
            $imageName = time().'.'.$request->foto_produk->extension();
            $request->foto_produk->move(public_path('images'). $imageName);
            $data['foto_produk'] = $imageName;
        }

        Product::create($data);

        return response()->json(['success' => 'Produk Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //hapus foto jika ada 
        if ($product->foto_produk && file_exists(public_path('images/'.$product->foto_produk))) {
            unlink(public_path('images/'.$product->foto_produk));
        }

        //sintaks delete produk
        
    }
}
