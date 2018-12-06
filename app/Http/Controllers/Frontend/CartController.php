<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Product;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    /**
     * Show the list of cart items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cart::content();
        return view('frontend.cart.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        try {
            Cart::add(
                $product->id,
                $product->name,
                1,
                $product->price,
                [
                    'image_url' => $product->images->first()->url
                ]
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return redirect()->route('cart.index');
    }

    /**
     * Remove cart item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Cart::remove($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return redirect()->route('cart.index');
    }

     /**
     * Update cart item.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            Cart::update($id, ['qty' => request('qty')]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return redirect()->route('cart.index');
    }

     /**
     * Empty cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function empty()
    {
        try {
            Cart::destroy();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $items   = Cart::content();
        $address = Address::where(['user_id' => auth()->id(), 'is_main_address' => true])->first();
        return view('frontend.cart.checkout', compact('items', 'address'));
    }
}
