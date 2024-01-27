<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSearch
{
    public static function search($filters)
    {
        $products = Product::query();

        if (isset($filters['title'])) {
            $products->where('title', 'like', '%'.$filters['title'].'%');
        }

        if (isset($filters['max_price'])) {
            $columns = isset($filters['delivery']) ? DB::raw('price + shipping_price') : 'price';
            $products->where($columns, '<=', $filters['max_price']);
        }

        if (isset($filters['sort_price_desc'])) {
            $products->orderBy('price', 'asc');
        }

        return $products->with('media')->paginate(8);

    }
}
