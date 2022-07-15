<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $customers = Customer::all();
        $orders = Order::all();
        $products = Product::all()->where('qty', '>=', '1');
        $lastID = Order_Detail::max('order_id');
        $order_receipt = Order_Detail::where('order_id', $lastID)->join('orders', 'orders.id', '=', 'order_details.order_id')->get();
        return view('orders.index', compact('orders', 'products', 'order_receipt', 'customers',));
    }

    public function api()
    {
        $customers = Customer::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        DB::transaction(
            function () use ($request) {
                $orders = new Order();
                $orders->name = $request->customer_name;
                $orders->phone = $request->customer_phone;
                $orders->save();
                $order_id = $orders->id;

                // order_details
                foreach ($request->product_id as $key => $product) {
                    $orders->order_detail()->create([
                        'product_id' => $product,
                        'qty' => $request->qty[$key]->decrement('qty'),
                        'price' => $request->price[$key],
                        'amount' => $request->total_amount[$key],
                        'discount' => $request->discount[$key] ?? 0,
                    ]);
                }

                // transaction
                $order_id = $orders->id;
                $transaction = new Transaction;
                $transaction->order_id = $order_id;
                $transaction->user_id = Auth::user()->id;
                $transaction->balance = $request->balance;
                $transaction->paid_amount = $request->paid_amount;
                $transaction->payment_method = $request->payment_method;
                $transaction->transac_date = date('Y-m-d');
                $transaction->transac_amount = ($request->paid_amount -= $request->balance);
                $transaction->save();

                //last order history
                $products = Product::all();
                $order_details = Order_Detail::where('order_id', $order_id)->get();
                $order_details = Order_Detail::where('order_id', $orders->getKey())->get();
                $orderedBy = Order::where('id', $order_id)->get();
                $orderedBy = Order::where('id', $orders->getKey())->get();

                // pengurangan stock
                // Jika satu product yang dibeli
                $qty = $request->qty;
                if (COUNT(array($qty)) == 1) {
                    DB::table('products')->where('id', $qty)->decrement('qty');
                }
                // Jika ada lebih dari satu product yang dipinjam
                if (COUNT($qty) > 1) {
                    foreach ($qty as $id) {
                        DB::table('products')->where('id', $id)->decrement('qty');
                    }
                }
                return view('orders.index', ['product' => $products, 'order_details' => $order_details, 'cutomer_orders' => $orderedBy]);
            }
        );
        return back()->with('success', 'Your Orders Successfull to Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
