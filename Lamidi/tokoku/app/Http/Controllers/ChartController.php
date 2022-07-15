<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Http\Requests\StoreChartRequest;
use App\Http\Requests\UpdateChartRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use mikehaertl\wkhtmlto\Pdf;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Transaction::join('orders', 'orders.id', '=', 'transactions.order_id')->join('users', 'users.id', '=', 'transactions.user_id')
            ->get(['transactions.*', 'orders.name as nameo', 'users.name as nameu']);
        $total_order = Order::count();
        $total_supplier = Supplier::count();
        $total_customer = Customer::count();
        $total_cashier = User::select(DB::raw("COUNT(is_admin) as total"))->where('is_admin', '=', 2)->pluck('total');
        $data_donut = Order_Detail::select(DB::raw("COUNT(product_id) as total"))->groupby('product_id')->orderby('product_id', 'asc')->pluck('total');
        $label_donut = Product::orderBy('products.id', 'asc')->join('order_details', 'order_details.product_id', '=', 'products.id')->groupby('product_name')->pluck('product_name');
        $data_donut2 = Transaction::select(DB::raw("COUNT(user_id) as total"))->groupby('user_id')->orderby('user_id', 'asc')->pluck('total');
        $label_donut2 = User::orderBy('users.id', 'asc')->join('transactions', 'transactions.user_id', '=', 'users.id')->groupby('name')->pluck('name');
        $pieDatas = Product::select(DB::raw("COUNT(supplier) as total"))->groupby('supplier')->orderby('supplier', 'asc')->pluck('total');
        $pieLabel = Supplier::orderBy('suppliers.id', 'asc')->join('products', 'products.supplier', '=', 'suppliers.id')->groupby('supplier_name')->pluck('supplier_name');
        $pieDatas2 = Order_Detail::select(DB::raw("COUNT(order_id) as total"))->groupby('order_id')->orderby('order_id', 'asc')->pluck('total');
        $pieLabel2 = Order::orderBy('orders.id', 'asc')->join('order_details', 'order_details.order_id', '=', 'orders.id')->groupby('name')->pluck('name');
        return view('charts.index', compact('orders', 'total_order', 'total_supplier', 'total_customer', 'data_donut', 'total_cashier', 'label_donut', 'data_donut2', 'label_donut2', 'pieDatas', 'pieLabel', 'pieDatas2', 'pieLabel2'));
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
     * @param  \App\Http\Requests\StoreChartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChartRequest  $request
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChartRequest $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Transaction::whereIn('id', $ids)->delete();
        $qty = Product::select('id', $ids);
        // Return qty buku yg dipinjam
        if (COUNT(array($qty)) > 1) {
            DB::table('products')->where('id', $qty)->increment('qty');
        }
        return response()->json(['warning' => "Transaction deleted successfully."]);
    }
}
