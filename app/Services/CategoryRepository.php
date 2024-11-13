<?php

namespace App\Services;

use App\Models\Category;

class CategoryRepository extends AbstractCrud
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    // Bạn có thể thêm các phương thức riêng cho danh mục tại đây
}