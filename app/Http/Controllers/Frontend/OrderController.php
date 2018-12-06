<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Address;
use App\Product;
use Cart;

class OrderController extends Controller
{
    private $order;
    private $address;

    function __construct(Order $order, Address $address)
    {
        $this->order   = $order;
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::buyer(auth()->id())->paginate(10);
        $salescount = Order::salescount(auth()->id());

        return view('frontend.order.index', compact('orders', 'salescount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->order->createOrder($request);

        Cart::destroy();

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('frontend.order.show', compact('order'));
    }

    /**
     * Display List of sales
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $orders = Order::seller(auth()->id())->paginate(20);
        $transactioncount = Order::transactioncount(auth()->id());

        return view('frontend.order.sales', compact('orders', 'transactioncount'));
    }
}
