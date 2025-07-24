<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;

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

        return view('admin.index', compact(
            'totalRevenue', 'totalOrders', 'totalCustomers', 'totalReviews',
            'revenueChart', 'orderChart', 'customerChart', 'reviewChart', 'type'
        ));
    }
}