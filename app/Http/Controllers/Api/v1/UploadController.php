<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Http\Resources\MediaResource;
use App\Models\Product;
use App\Helpers\ImageResizer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    protected $random_file_name;
    const image_width=500;

    public function __construct()
    {
        $this->random_file_name = Str::random(40);
    }

    public function upload(Request $request)
    {
        // validate requests in production with form requests.
        $this->validate_product_ownership($request);
        $image=$this->resize($request);
        $extension=$request->file('media')->getClientOriginalExtension();
        Storage::disk('public')->put('media/'.$this->random_file_name.'.'.$extension , $image);
        $media = Media::create([
            'location' => 'media/'.$this->random_file_name.'.'.$extension,
            'product_id'=>$request->product_id
        ]);
        return new MediaResource($media);
    }

    // in many use cases we need to insure users can only upload media or their products.
    // this part depends in bussiness logi
    public function validate_product_ownership($request) 
    {
        $product=Product::find($request->product_id);
        $this->authorize('owner', $product);
    }

    public function resize($request)
    {
        $image=ImageResizer::resize($request,self::image_width); // keep aspect ratio
        return $image;
    }

}
