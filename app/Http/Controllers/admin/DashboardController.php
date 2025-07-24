<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class DashboardController
{
    public function index(\Illuminate\Http\Request $request)
    {
        $type = $request->get('type', 'week'); // week, month, year

        if ($type == 'month') {
            $start = now()->startOfMonth();
            $end = now()->endOfMonth();
            $groupFormat = '%Y-%m-%d';
        } elseif ($type == 'year') {
            $start = now()->startOfYear();
            $end = now()->endOfYear();
            $groupFormat = '%Y-%m';
        } else { // week
            $start = now()->startOfWeek();
            $end = now()->endOfWeek();
            $groupFormat = '%Y-%m-%d';
        }

        $totalRevenue = Order::where('order_status', 'delivered')->whereBetween('created_at', [$start, $end])->sum('total_amount');
        $totalOrders = Order::whereBetween('created_at', [$start, $end])->count();
        $totalCustomers = User::whereBetween('created_at', [$start, $end])->count();
        $totalReviews = Review::whereBetween('created_at', [$start, $end])->count();

        $revenueChart = Order::where('order_status', 'delivered')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, SUM(total_amount) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $orderChart = Order::whereBetween('created_at', [$start, $end])
            ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, COUNT(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $customerChart = User::whereBetween('created_at', [$start, $end])
            ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, COUNT(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $reviewChart = Review::whereBetween('created_at', [$start, $end])
            ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, COUNT(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $topProducts = OrderItem::select('product_id')
            ->selectRaw('SUM(quantity) as total_sales')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->take(6)
            ->get();
        $topProducts = OrderItem::select('product_id', 'product_variant_id')
            ->selectRaw('SUM(quantity) as total_sales')
            ->with([
                'product',
                'productVariant' => function ($q) {
                    $q->with('image');
                }
            ])
            ->groupBy('product_id', 'product_variant_id')
            ->orderByDesc('total_sales')
            ->take(6)
            ->get();
        $recentOrders = Order::with(['orderItems.product', 'orderItems.productVariant', 'user'])
            ->orderByDesc('created_at')
            ->paginate(5);
            
        return view('admin.index', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalReviews',
            'revenueChart',
            'orderChart',
            'customerChart',
            'reviewChart',
            'type',
            'topProducts',
            'recentOrders'
        ));
    }
    public function fetchData(Request $request)
{
    $type = $request->input('type', 'week');

    $data = $this->getDashboardData($type); // Tách logic ra nếu cần

    return response()->json([
        'totalRevenue' => number_format($data['totalRevenue'], 0, ',', '.'),
        'totalOrders' => $data['totalOrders'],
        'totalCustomers' => $data['totalCustomers'],
        'totalReviews' => $data['totalReviews'],
        'revenueChart' => $data['revenueChart'],
        'orderChart' => $data['orderChart'],
        'customerChart' => $data['customerChart'],
        'reviewChart' => $data['reviewChart'],
    ]);
}

/**
 *
 * @param string $type
 * @return array
 */
protected function getDashboardData($type = 'week')
{
    if ($type == 'month') {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();
        $groupFormat = '%Y-%m-%d';
    } elseif ($type == 'year') {
        $start = now()->startOfYear();
        $end = now()->endOfYear();
        $groupFormat = '%Y-%m';
    } else { // week
        $start = now()->startOfWeek();
        $end = now()->endOfWeek();
        $groupFormat = '%Y-%m-%d';
    }

    $totalRevenue = Order::where('order_status', 'delivered')->whereBetween('created_at', [$start, $end])->sum('total_amount');
    $totalOrders = Order::whereBetween('created_at', [$start, $end])->count();
    $totalCustomers = User::whereBetween('created_at', [$start, $end])->count();
    $totalReviews = Review::whereBetween('created_at', [$start, $end])->count();

    $revenueChart = Order::where('order_status', 'delivered')
        ->whereBetween('created_at', [$start, $end])
        ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, SUM(total_amount) as total")
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $orderChart = Order::whereBetween('created_at', [$start, $end])
        ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, COUNT(*) as total")
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $customerChart = User::whereBetween('created_at', [$start, $end])
        ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, COUNT(*) as total")
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $reviewChart = Review::whereBetween('created_at', [$start, $end])
        ->selectRaw("DATE_FORMAT(created_at, '{$groupFormat}') as date, COUNT(*) as total")
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    return [
        'totalRevenue' => $totalRevenue,
        'totalOrders' => $totalOrders,
        'totalCustomers' => $totalCustomers,
        'totalReviews' => $totalReviews,
        'revenueChart' => $revenueChart,
        'orderChart' => $orderChart,
        'customerChart' => $customerChart,
        'reviewChart' => $reviewChart,
    ];
}
}
