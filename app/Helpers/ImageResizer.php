<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageResizer{

    public static function resize(Request $request,$width)
    {
        //resize image .
        //this function can be customized for example  crop, disable aspectration ....
        $image_resize = Image::make($request->file('media'))->resize($width, $width,function ($constraint) {
            $constraint->aspectRatio();
        })->stream();
        
        return $image_resize;

    }
}