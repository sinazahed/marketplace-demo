<?php

namespace App\Services\Order;

use App\Models\Product;

class ValidateProductService
{

    // this class can be contain any login of validation products.
    // for example when we want to transfer the product ownership validation from query level to code base or anything else.

    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function validate_products()
    {
        // throw exeption when product not found , responce can be change  or anything else.
        if (count($this->products) == 0 || empty($this->products) ) {
            throw new \InvalidArgumentException('No product');
        }

        // Additional logic if needed

        return $this->products;
    }
}
