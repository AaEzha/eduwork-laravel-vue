<?php

namespace App\Http\Controllers;

require 'C:\xampp\htdocs\eduwork\tokoku\vendor\autoload.php';

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Picqer;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        $suppliers = Supplier::all();
        return view('products.index', compact('products', 'suppliers'));
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
        $products = new Product;
        $product_code = $request->product_code;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $file->move('assets/products/images/', $file->getClientOriginalName());
            $product_image = $file->getClientOriginalName();
            $products->product_image = $product_image;
        }
        $redColor = [255, 0, 0];
        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents(
            'assets/products/barcodes/' . $product_code . '.jpg',
            $generator->getBarcode(
                $product_code,
                $generator::TYPE_CODE_128,
                3,
                50,
                $redColor
            )
        );
        $products->product_name = $request->product_name;
        $products->product_code = $product_code;
        $products->description = $request->description;
        $products->brand = $request->brand;
        $products->price = $request->price;
        $products->qty = $request->qty;
        $products->supplier = $request->supplier;
        $products->alert_stock = $request->alert_stock;
        $products->barcode = $product_code . '.jpg';
        $products->save();
        if ($products) {
            return redirect()->back()->with('product Created Successfully');
        }
        return redirect()->back()->with('product Failed To Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('products.edit', compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $products)
    {
        $product_code = $request->product_code;
        $products = Product::find($products);
        if ($request->hasFile('product_image')) {
            if ($products->product_image != '') {
                $image_path = 'assets/products/images/' . $products->product_image;
                unlink($image_path);
            }
            $file = $request->file('product_image');
            $file->move('assets/products/images/', $file->getClientOriginalName());
            $product_image = $file->getClientOriginalName();
            $products->product_image = $product_image;
        }
        if ($request->product_code != '' && $request->product_code != $products->product_code) {
            $unique = Product::where('product_code', $product_code)->first();
            if ($unique) {
                return redirect()->back()->with('Error', 'Product Code Already Taken!');
            }
            if ($products->barcode != '') {
                $barcode_path = 'assets/products/barcodes/' . $products->barcode;
                unlink($barcode_path);
            }
            $redColor = [255, 0, 0];
            $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
            file_put_contents(
                'assets/products/barcodes/' . $product_code . '.jpg',
                $generator->getBarcode(
                    $product_code,
                    $generator::TYPE_CODE_128,
                    3,
                    50,
                    $redColor
                )
            );
            $products->barcode = $product_code . '.jpg';
        }
        $products->product_name = $request->product_name;
        $products->product_code = $product_code;
        $products->description = $request->description;
        $products->brand = $request->brand;
        $products->price = $request->price;
        $products->qty = $request->qty;
        $products->supplier = $request->supplier;
        $products->alert_stock = $request->alert_stock;
        $products->save();
        if (!$products) {
            return back()->with('Error', 'Product not Found');
        }
        return redirect()->back()->with('Success', 'Product Updated Sucessfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('Success', 'Product Deleted Sucessfully!');
    }
    public function getproductbarcodes()
    {
        $productbarcodes = Product::select('barcode', 'product_code')->get();
        return view('products.barcode.index', compact('productbarcodes'));
    }
}
