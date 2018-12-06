<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Address;

class AddressApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::where('user_id', auth()->id())->orderBy('is_main_address', 'desc')->get();
        return response($address->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($searchQuery)
    {
        $address = Address::where('address_name', 'like', '%'.$searchQuery.'%')
                   ->where('user_id', auth()->id())
                   ->orderBy('is_main_address', 'desc')->get();

        return response($address->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddressById(Address $address)
    {
        return response($address->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMainAddress()
    {
        $address = Address::where(['user_id' => auth()->id(), 'is_main_address' => true])->first();
        return response($address->jsonSerialize(), Response::HTTP_OK);
    }
}
