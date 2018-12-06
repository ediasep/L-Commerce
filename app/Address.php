<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;

	public $fillable = ['user_id', 'address_name', 'first_name', 'last_name', 'email', 'phone', 'full_address', 'suburb_or_town', 'state_or_territory', 'post_code', 'is_main_address'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function createAddress($request)
    {
        $existing_address = Address::where('user_id', auth()->id())->get();
        $is_main_address  = $existing_address->count() > 0 ? null : true;

		$address = Address::create([
            'user_id'            => auth()->id(),
            'address_name'       => $request->address_name,
            'first_name'         => $request->first_name,
            'last_name'          => $request->last_name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'full_address'       => $request->full_address,
            'suburb_or_town'     => $request->suburb_or_town,
            'state_or_territory' => $request->state_or_territory,
            'post_code'          => $request->post_code,
            'is_main_address'    => $is_main_address,
        ]);

        return $address;
    }
}
