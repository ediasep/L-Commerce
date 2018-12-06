<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public $address;

    public function __construct(Address $address){
        $this->middleware('auth');
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->orderBy('is_main_address', 'desc')->paginate(5);
        return view('frontend.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->address->createAddress($request);
        return redirect()->route('address.index')->with('flash', 'Address has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return view('frontend.address.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('frontend.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $address->address_name = request('address_name');
        $address->first_name = request('first_name');
        $address->last_name = request('last_name');
        $address->email = request('email');
        $address->phone = request('phone');
        $address->full_address = request('full_address');
        $address->suburb_or_town = request('suburb_or_town');
        $address->state_or_territory = request('state_or_territory');
        $address->post_code = request('post_code');
        $address->save();

        return redirect()->route('address.index')->with('flash', 'Address has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        if($address->user_id == auth()->id()) {
            $address->delete();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function set_main_address(Address $address)
    {
        if($address->user_id == auth()->id()) {
            Address::where('user_id', auth()->id())
            ->update(['is_main_address' => false]);

            $address->is_main_address = true;
            $address->save();
        }

        return back();
    }
}
