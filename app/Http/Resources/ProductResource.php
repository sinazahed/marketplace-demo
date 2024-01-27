<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return[
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>number_format($this->price),
            'shipping_price'=>number_format($this->shipping_price),
        ];
    }

    public function with($request)
    {
        return[
            'status'=>'success'
        ];
    }
}
