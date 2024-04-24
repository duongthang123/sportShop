<?php

namespace App\Http\Repository;

use App\Models\Order;
use App\Models\ProductOrder;

class OrderProductRepository
{
    protected $productOrder;

    public function __construct(ProductOrder $productOrder)
    {
        $this->productOrder = $productOrder;
    }


}
