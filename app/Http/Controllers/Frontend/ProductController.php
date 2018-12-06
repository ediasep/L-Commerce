<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use App\Category;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\ProductFilters;

class ProductController extends Controller
{
    public function __construct(){

        $this->middleware('auth')->except(['index', 'show']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilters $filters)
    {
        $products = Product::latest()->filter($filters)->paginate(25);
        $categories = Category::all();

        return view('frontend.product.index', compact('products', 'categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myproduct() {
        $products = Product::where('user_id', auth()->id())->paginate(20);
        return view('frontend.product.my', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('frontend.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'name'        => 'required',
            'price'       => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'images'      => 'required',
        ]);

        $product = Product::create([
          'name'        => request('name'),
          'description' => request('description'),
          'user_id'     => auth()->id(),
          'price'       => request('price'),
          'category_id' => request('category_id'),
          'slug'        => createSlug(request('name')),
          'shop_id'     => auth()->user()->shop->id,
        ]);

        Image::upload_product_images($product->id);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('frontend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('frontend.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate(request(), [
            'name'        => 'required',
            'price'       => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $product->name = request('name');
        $product->description = request('description');
        $product->user_id = auth()->id();
        $product->price = request('price');
        $product->category_id = request('category_id');
        $product->save();

        Image::upload_product_images($product->id, request('existings'));

        return redirect()->route('product.my');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->user_id == auth()->id()) {
            $product->delete();
        }

        return back();
    }
}
