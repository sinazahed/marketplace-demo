<?php
namespace App\Services\Order;
use App\Models\Product;
use App\Services\Order\ValidateProductService;
use Illuminate\Support\Collection;

class OrderService{

    public $products;
    public $delivery;

    public function __construct(Collection $products,$delivery)
    {
        $this->products = $products;
        $this->delivery=$delivery;
    }


    public function create_order()
    {
        (new ValidateProductService($this->products))->validate_products();  // this calss validate order product (bussiness login)
        $order_total_price = $this->calculate_order_total_price();
        $order = auth()->user()->orders()->create([
            'total' => $order_total_price,
        ]);
        return $this->create_order_details($order);
    }

    public function calculate_order_total_price()     // related to number 5 of advantages in pdf
    {
        if($this->delivery)
            return $this->products->sum('price') + $this->products->sum('shipping_price');  // final invoice price , included with each product shipping price
        return $this->products->sum('price');
    }

    public function create_order_details($order)
    {
        $order_details=$order->orderDetails()->createMany(
            $this->products->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'shipping_price' => $product->shipping_price,
                ];
            })->all()
        );
        return (object)['order'=>$order,'order_details'=>$order_details]; 
        // order contains total price and user info 
        // orderDetails contains wich product and bought price
        // we just email products name and total price but we also have product details to customize email. it depends on bussiness domain.
    }
}