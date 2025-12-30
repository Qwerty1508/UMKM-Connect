<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductManager extends Component
{
    use WithFileUploads;

    public $products;
    public $name, $description, $price, $stock, $image;
    public $productId;
    public $isModalOpen = false;

    public function render()
    {
        $this->products = Product::where('store_id', 1)->get(); // Static Store ID for prototype
        return view('livewire.product-manager');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->image = null;
        $this->productId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        Product::updateOrCreate(['id' => $this->productId], [
            'store_id' => 1,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imagePath,
            'is_available' => true,
        ]);

        session()->flash('message', $this->productId ? 'Produk diperbarui.' : 'Produk ditambahkan.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Produk dihapus.');
    }

    public function toggleStatus($id)
    {
        $product = Product::find($id);
        $product->is_available = !$product->is_available;
        $product->save();
    }
}
