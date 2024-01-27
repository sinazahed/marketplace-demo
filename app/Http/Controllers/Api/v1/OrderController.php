<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OrderResource;
use App\Models\User;
use App\Events\OrderCreatedEvent;
use App\Services\Order\OrderService;

class OrderController extends Controller
{

    public function create(Request $request)
    {
        // validate incoming data in production
        // ensure users can not order their own product , this is in query level , but also can be done in code level too.
        $products = Product::whereIn('id', $request->product_id)->where('user_id', '!=' ,auth()->user()->id )->get(['id','price','shipping_price','title']);
        $order_with_details=(new OrderService($products,$request->delivery))->create_order();
        $this->send_mail($order_with_details,$products);
        return new OrderResource($order_with_details->order);  
        // the order_with_details object contain the order info.      
        // all info about order , details , user are accessible in view with order_with_details.

        
    }

    public function send_mail($order_with_details,$products)
    {
        // be sure the env file mail parameters for sending message is correct.
        try {
            OrderCreatedEvent::dispatch($order_with_details,$products);        
        } catch (\Exception $e) {
            return true;
        }
    }
}
