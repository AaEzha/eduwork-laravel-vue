<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class Products extends Component
{
    public $products_details = [];
    // public $suppliers = [];
    public function mount()
    {
    }
    public function ProductDetails($product_id)
    {
        $this->products_details = Product::where('id', $product_id)->get();
    }
    // public function Suppliers($supplier_id)
    // {
    //     $this->suppliers = Supplier::where('id', $supplier_id)->get();
    // }
    public function render()
    {
        return view('livewire.products', ['products' => Product::all(), 'suppliers' => Supplier::all()]);
    }
}
