<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;

class ImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {

        if($image->product->user_id == auth()->id())
        {
            $image->delete();
        }

        return back();
    }
}
