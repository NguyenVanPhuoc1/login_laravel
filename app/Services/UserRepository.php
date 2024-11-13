<?php

namespace App\Services;

use App\Models\User;

class UserRepository extends AbstractCrud
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // Bạn có thể thêm các phương thức riêng cho user tại đây
}