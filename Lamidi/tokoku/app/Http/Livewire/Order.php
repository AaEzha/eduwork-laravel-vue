<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Order extends Component
{
    public $orders, $products = [], $product_code, $message = '', $productincart;
    public function mount()
    {
        $this->products = Product::all();
        $this->productincart = Cart::all();
    }
    public function insertocart()
    {
        $countproduct = Product::where('id', $this->product_code)->first();
        if (!$countproduct) {
            return $this->message = 'Product Not Found';
        }
        $countcartproduct = Cart::where('product_id', $this->product_code)->count();
        if ($countcartproduct > 0) {
            return $this->message = 'Product' . $countproduct->product_name . 'already exist in cart please add qty';
        }
        $addtocart = new Cart;
        $addtocart->product_id = $countproduct->id;
        $addtocart->product_qty = $countproduct->qty;
        $addtocart->product_price = $countproduct->price;
        $addtocart->user_id = Auth::user()->id;
        $addtocart->save();
        $this->productincart->prepend($addtocart);
        $this->product_code = '';
        return $this->message = 'Product added succesfully!';
    }

    public function incrementqty($orderid)
    {
        $order = Order::find($orderid);
        $order->increment('qty', 1);
        $updatprice = $order->qty * $order->product->price;
        $order->update(['price' => $updatprice]);
    }
    public function removeproduct($cartid)
    {
        $deletecart = Cart::find($cartid);
        $deletecart->delete();
        $this->message = "Product removed from cart";
        $this->productincart = $this->productincart->except($cartid);
    }
    public function render()
    {
        return view('livewire.order');
    }
}
