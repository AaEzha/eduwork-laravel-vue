<?php

namespace App\Http\Controllers;

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
        $orders = Order::all();
        $products = Product::all();
        return view('orders.index', compact('orders', 'products'));
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
                $orders->address = $request->customer_phone;
                $orders->save();

                // $product_id = $request->product_id;

                // order_details
                $total_amount = 0;
                foreach ($request->product_id as $key => $product) {
                    $orders->order_details()->create([
                        'product_id' => $product,
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'amount' => $request->total_amount[$key],
                        'discount' => $request->discount[$key] ?? 0,
                    ]);
                    $total_amount += $request->total_amount[$key];
                }

                // transaction
                $orders->transaction()->create([
                    'paid_amount' => $request->paid_amount ?? 0,
                    'balance' => $request->balance ?? 0,
                    'payment_method' => $request->payment_method,
                    'user_id' => auth()->user()->id,
                    'transac_date' => now(),
                    'transac_amount' => $total_amount
                ]);

                // if (count($product_id) > 0) {
                //     foreach ($product_id as $item => $value) {
                //         $data2 = array(
                //             'order_id' => $orders->id,
                //             'product_id' => $product_id[$item],
                //             'qty' => $request->qty,
                //             'price' => $request->price,
                //             'amount' => $request->total_amount,
                //             'discount' => $request->discount,
                //             'transac_amount' => $request->transac_amount,
                //         );
                //         $orders->product_id()->attach($value);
                //         Order_Detail::create($data2);
                //     }
                // }
                // if (is_countable($product_id) && count($product_id) > 0) {
                //     $order_details = new Order_Detail;
                //     $order_details->order_id = $request->order_id;
                //     $order_details->product_id = $request->product_id;
                //     $order_details->qty = $request->qty;
                //     $order_details->price = $request->price;
                //     $order_details->amount = $request->total_amount;
                //     $order_details->discount = $request->discount;
                //     $order_details->save();
                // }
                // $order_id = $orders->id;
                // $transaction = new Transaction;
                // $transaction->order_id = $order_id;
                // $transaction->user_id = Auth::user()->id;
                // $transaction->balance = $request->balance;
                // $transaction->paid_amount = $request->paid_amount;
                // $transaction->payment_method = $request->payment_method;
                // $transaction->transac_date = date('Y-m-d');
                // $transaction->transac_amount = $request->amount;
                // $transaction->save();

                $products = Product::all();
                $order_details = Order_Detail::where('order_id', $orders->getKey())->get();
                $orderedBy = Order::where('id', $orders->getKey())->get();
                return view('orders.index', ['product' => $products, 'order_details' => $order_details, 'cutomer_orders' => $orderedBy]);
            }
        );
        return back()->with("Product orders Failed to inserted! check your inputs!");
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
