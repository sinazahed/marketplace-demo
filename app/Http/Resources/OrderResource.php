<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

class OrderResource extends JsonResource
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
            'total_price'=>number_format($this->total),
        ];
    }

    public function with($request)
    {
        return[
            'status'=>'success'
        ];
    }
}
