<?php

use App\Models\User;
use App\Models\Product;

function count_product()
{
    $count = Product::count();
    return $count;
}
function count_user()
{
    $count = User::where('role_id', 2)->count();
    return $count;
}
