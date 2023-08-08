<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {   
        $orders = DB::table('orders')->whereNotIn('status', [1,5])->get();

        $productCount = [];

        foreach ($orders as $order) {
            $products = json_decode($order->content, true);

            foreach ($products as $product) {
                $productName = $product['name'];

                if (isset($productCount[$productName])) {
                    $productCount[$productName]['quantity'] += $product['qty'];
                    $productCount[$productName]['price'] = $product['price'];
                } else {
                    $productCount[$productName] = [
                        'quantity' => $product['qty'],
                        'price' => $product['price'],
                    ];
                }
            }
        }

        arsort($productCount);
        $topProducts = array_slice($productCount, 0, 5, true);

        $data = [
            'users' => User::doesntHave('roles')->count(),
            'comentarios' => DB::table('reviews')->count(),
            'ordenes' => DB::table('orders')->whereNotIn('status', [1,5])->sum('total'),
            'topproducts' => $topProducts,
            'topusers' =>  DB::table('orders')
                            ->select('user_id', DB::raw('SUM(total) as total_spent'))
                            ->whereNotIn('status', [1,5])
                            ->groupBy('user_id')
                            ->orderByDesc('total_spent')
                            ->limit(10)
                            ->get(),
            'productospublicados' => DB::table('products')->where('status',2)->count(),
            'productsstock' => DB::table('products')
                            ->select('products.id', 'products.name', DB::raw('COALESCE(subquery.total_quantity, 0) as total_quantity'))
                            ->leftJoin(DB::raw('(SELECT color_product.product_id, SUM(color_product.quantity) as total_quantity FROM color_product GROUP BY color_product.product_id
                                UNION ALL
                                SELECT color_size.size_id, SUM(color_size.quantity) as total_quantity FROM color_size GROUP BY color_size.size_id) as subquery'), 'products.id', '=', 'subquery.product_id')
                            ->orderBy('total_quantity')
                            ->limit(10)
                            ->get(),

        ];

        return view('admin.dashboard.index')->with($data);
    }
}
