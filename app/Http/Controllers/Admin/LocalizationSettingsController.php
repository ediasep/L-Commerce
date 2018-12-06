<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LocalizationSetting;

class LocalizationSettingsController extends Controller
{
    public function index() {
    	$localization_setting = LocalizationSetting::first();
    	return view('admin.localization.index', compact('localization_setting'));
    }

    public function update(LocalizationSetting $localizationsetting) {
    	try {

	        $this->validate(request(), [
	            'language' => 'required',
	            'currency' => 'required',
	        ]);

	    	$localizationsetting->language = request('language');
	    	$localizationsetting->currency = request('currency');
	    	$localizationsetting->save();   		
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}

    	return back()->with('flash', 'Setting has been successfully updated');
    }
}
