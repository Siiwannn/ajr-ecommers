<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::latest()->paginate(8);
        return view('livewire.product-list', compact('products'));
    }
}
