<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use App\Helpers\ProductSearch;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        //validate request in production
        $product = auth()->user()->products()->create($request->only([
            'title',
            'price',
            'shipping_price'
        ]));
        return new ProductResource($product);
    }

    public function explore(Request $request)
    {
        // validate search string
        $product=ProductSearch::search($request->only('title','max_price','sort_price_desc','delivery'));
        return new ProductCollection($product);
    }

    public function destroy($product)
    {
        // also with route modelBinding
        $product=Product::find($product);
        if(empty($product))
            return response()->json(['data'=>['message' => 'not found',]],404);
        $this->authorize('owner', $product);
        $product->delete();
        return response()->json(['data'=>['message' => 'Product deleted successfully','status'=>'success']],200);
    }
}
