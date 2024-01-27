<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;


class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function ($item){
            
            return[
                'id'=>$item->id,
                'title'=>$item->title,
                'price'=>$item->price,
                'shipping_price'=>$item->shipping_price,
                'price_with_shipping'=>$item->price+$item->shipping_price,
                'medias'=>MediaResource::collection($item->media)
            ];
         });
    }

    public function with($request)
    {
        return[
            'status'=>'success'
        ];
    }
}
