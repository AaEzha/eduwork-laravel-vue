<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(5);
        return view('suppliers.index', compact('suppliers'));
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
        $suppliers = new Supplier;
        $suppliers->supplier_name = $request->supplier_name;
        $suppliers->email = $request->email;
        $suppliers->phone = $request->phone;
        $suppliers->address = $request->address;
        $suppliers->save();
        if ($suppliers) {
            return redirect()->back()->with('success', 'Supplier Successfully Inserted');
        }
        return redirect()->back()->with('error', 'Supplier Failed To Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $transaction)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $suppliers)
    {
        $suppliers = Supplier::find($suppliers);
        $suppliers->supplier_name = $request->supplier_name;
        $suppliers->email = $request->email;
        $suppliers->phone = $request->phone;
        $suppliers->address = $request->address;
        $suppliers->save();
        if (!$suppliers) {
            return back()->with('error', 'Supplier not Found');
        }
        // $suppliers->update($request->all());
        return back()->with('info', 'Supplier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suppliers = Supplier::find($id);
        if (!$suppliers) {
            return back()->with('error', 'Supplier not Found');
        }
        $suppliers->delete();
        return back()->with('warning', 'Supplier Deleted Successfully');
    }
}
