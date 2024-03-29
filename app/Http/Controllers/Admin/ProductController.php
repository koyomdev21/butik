<?php

namespace App\Http\Controllers\Admin;

use File;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
       return view('admin.product.index', compact('products')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product-> user_id = Auth::id();
        $product-> category_id = $request->category;
        $product-> name = $request->name;
        $product-> price = $request->price;
        $product-> description = $request->description;
        // dd($product);

        $product->save();

        if($request->hasFile('image')){
            // rename file - 5-2021-09-03.jpg/xls
            $filename = $product->id.'-'.date("Y-m-d").'.'.$request->image->getClientOriginalExtension();

            // store attachment on storage
            Storage::disk('public')->put($filename, File::get($request->image));

            // update row
            $product->image = $filename;
            $product->save();
        }

        return redirect()-> route('product:index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        if($request->hasFile('image')){
            // rename file - 5-2021-09-03.jpg/xls
            $filename = $product->id.'-'.date("Y-m-d").'.'.$request->image->getClientOriginalExtension();

            // store attachment on storage
            Storage::disk('public')->put($filename, File::get($request->image));

            // update row
            $product->image = $filename;
            $product->save();
        }

        return redirect()->route('product:index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product -> delete();

        return redirect()-> route('product:index');
    }
}
