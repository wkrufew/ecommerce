<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function review(User $user, Product $product)
    {
        $reviews = $product->reviews()->where('user_id', $user->id)->count();

        if ($reviews) {
            return false;
        }

        $orders = Order::where('user_id', $user->id)->select('content')->get()->map(function ($order){
            return json_decode($order->content, true);
        });

        $products = $orders->collapse();
        
        return $products->contains('id', $product->id);
    }

    public function verify(User $user, Product $product)
    {
        $reviews = $product->reviews()->where('user_id', $user->id)->count();

        if ($reviews) {
            return true;
        }else {
            return false;
        }
    }
}
