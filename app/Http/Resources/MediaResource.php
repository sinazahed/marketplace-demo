<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'location'=>$this->location,
            'product_id'=>$this->product_id
        ];
    }

    public function with($request)
    {
        return[
            'status'=>'success'
        ];
    }
}
