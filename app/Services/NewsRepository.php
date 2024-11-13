<?php

namespace App\Services;

use App\Models\News;

class NewsRepository extends AbstractCrud
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    // Bạn có thể thêm các phương thức riêng cho tin tức tại đây
}