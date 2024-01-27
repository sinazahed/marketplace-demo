<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductOwnerShipPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }
}
