<?php

namespace App\Http\Controllers\Frontend;

use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = Shop::where('user_id', auth()->id())->first();
        if($shop) {
            return redirect()->route('shop.edit', $shop->id);
        }

        return view('frontend.shop.create');
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
            'user_id'     => 'unique:shops'
        ]);

        $shop = Shop::create([
          'name'        => request('name'),
          'description' => request('description'),
          'user_id'     => auth()->id()
        ]);

        if(request()->hasFile('image')) {
            $image = request()->file('image');
            Storage::disk('public')->put('images/', $image);
            $shop->logo = '/storage/images/'.$image->hashName();
            $shop->save();
        }

        return back()->with('flash', 'Shop has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view('frontend.shop.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('frontend.shop.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->validate(request(), [
            'name'        => 'required',
            'user_id'     => 'unique:shops'
        ]);

        $shop->name = request('name');
        $shop->description = request('description');

        if(request()->hasFile('image')) {
            $image = request()->file('image');
            Storage::disk('public')->put('images/', $image);
            $shop->logo = '/storage/images/'.$image->hashName();
        }

        $shop->save();

        return back()->with('flash', 'Shop has been successfully updated!');
    }
}
