<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithFileUploads;

    public $products;
    public $product_id;
    public $name;
    public $price;
    public $description;
    public $brand;
    public $category;
    public $image;
    public $old_image;
    public $isEdit = false;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable',
        'brand' => 'nullable',
        'category' => 'nullable',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::latest()->get();
    }

    public function resetForm()
    {
        $this->reset(['product_id', 'name', 'price', 'description', 'brand', 'category', 'image', 'old_image', 'isEdit']);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        $imageName = null;
        if ($this->image) {
            $imageName = time() . '_' . $this->image->getClientOriginalName();
            $this->image->storeAs('products', $imageName, 'public');
        }

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'brand' => $this->brand,
            'category' => $this->category,
            'image' => $imageName,
        ]);

        session()->flash('message', 'Produk berhasil ditambahkan!');
        $this->resetForm();
        $this->loadProducts();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->brand = $product->brand;
        $this->category = $product->category;
        $this->old_image = $product->image;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);

        $imageName = $this->old_image;
        if ($this->image) {
            // Hapus gambar lama
            if ($this->old_image && Storage::disk('public')->exists('products/' . $this->old_image)) {
                Storage::disk('public')->delete('products/' . $this->old_image);
            }
            
            $imageName = time() . '_' . $this->image->getClientOriginalName();
            $this->image->storeAs('products', $imageName, 'public');
        }

        $product->update([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'brand' => $this->brand,
            'category' => $this->category,
            'image' => $imageName,
        ]);

        session()->flash('message', 'Produk berhasil diupdate!');
        $this->resetForm();
        $this->loadProducts();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus gambar
        if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
            Storage::disk('public')->delete('products/' . $product->image);
        }
        
        $product->delete();
        
        session()->flash('message', 'Produk berhasil dihapus!');
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.admin.product-manager');
    }
}