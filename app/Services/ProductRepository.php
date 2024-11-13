<?php

namespace App\Services;

use App\Models\Product;

class ProductRepository extends AbstractCrud
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    // Bạn có thể thêm các phương thức riêng cho sản phẩm tại đây
}
