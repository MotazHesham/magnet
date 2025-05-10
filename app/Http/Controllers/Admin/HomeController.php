<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController
{
    
    public function updateStatuses(Request $request){ 
        $type = $request->type;
        $model = $request->model;
        $raw = $model::findOrFail($request->id);
        $raw->$type = $request->status; 
        $raw->save();
        return 1;
    }
    
    public function index()
    { 
        // Get total sales statistics
        $totalSales = Order::where('payment_status', 'paid')->sum('total');
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        $avgOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

        // Get sales growth
        $currentMonthSales = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('total');
        $lastMonthSales = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total');
        $salesGrowth = $lastMonthSales > 0 ? (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100 : 0;

        // Get customers growth
        $currentMonthCustomers = Customer::whereMonth('created_at', now()->month)->count();
        $lastMonthCustomers = Customer::whereMonth('created_at', now()->subMonth()->month)->count();
        $totalCustomersGrowth = $lastMonthCustomers > 0 ? (($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 : 0; 

        // Get avg order value growth
        $currentMonthAvgOrderValue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->avg('total');
        $lastMonthAvgOrderValue = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->avg('total');
        $avgOrderValueGrowth = $lastMonthAvgOrderValue > 0 ? (($currentMonthAvgOrderValue - $lastMonthAvgOrderValue) / $lastMonthAvgOrderValue) * 100 : 0;

        // Get orders growth
        $currentMonthOrders = Order::whereMonth('created_at', now()->month)->count();
        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)->count();
        $totalOrdersGrowth = $lastMonthOrders > 0 ? (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 : 0;

        // Overall Growth from last year
        $currentYearOrders = Order::whereYear('created_at', now()->year)->count();
        $lastYearOrders = Order::whereYear('created_at', now()->subYear()->year)->count();
        $overallGrowthFromLastYear = $lastYearOrders > 0 ? (($currentYearOrders - $lastYearOrders) / $lastYearOrders) * 100 : 0;

        // Get recent orders with user details
        $recentOrders = Order::with('user')
            ->with('orderOrderDetails')
            ->latest()
            ->take(5)
            ->get();

        // Get top selling products
        $topSellingProducts = Product::with('store')
            ->where('num_of_sale', '>', 0)
            ->orderBy('num_of_sale', 'desc')
            ->take(5)
            ->get();


        // Get order status statistics
        $orderStatuses = Order::select('delivery_status', DB::raw('count(*) as total'))
            ->groupBy('delivery_status')
            ->get();

        // Get newly added products
        $newProducts = Product::with('store','product_categories')
            ->latest()
            ->take(8)
            ->get();

        // Get monthly order statistics for the chart
        $monthlyOrderStats = [];
        for ($i = 12; $i >= 1; $i--) {
            $date = now()->setMonth($i)->setYear(now()->year);
            $monthlyOrderStats[] = [
                'month' => $date->format('M'),
                'store_rejected' => Order::where('delivery_status', 'store_rejected')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'client_received' => Order::where('delivery_status', 'client_received')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'canceled_from_client' => Order::where('delivery_status', 'canceled_from_client')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ];
        }
        $monthlyOrderStats = array_reverse($monthlyOrderStats);

        // Get top selling categories
        $topSellingCategories = ProductCategory::withSum('products', 'num_of_sale')
            ->orderByDesc('products_sum_num_of_sale')
            ->take(6)
            ->get(); 

        // Calculate total orders percentage for the radial chart
        $totalOrdersPercentage = $totalOrders > 0 ? 
            round(($currentYearOrders / $totalOrders) * 100) : 0;
            
        return view('home', compact(
            'totalSales',
            'currentMonthSales',
            'lastMonthSales',
            'salesGrowth',

            'totalOrders', 
            'currentMonthOrders',
            'lastMonthOrders',
            'totalOrdersGrowth',

            'totalCustomers',
            'totalCustomersGrowth',
            'currentMonthCustomers',
            'lastMonthCustomers',

            'avgOrderValue',
            'avgOrderValueGrowth',
            'currentMonthAvgOrderValue',
            'lastMonthAvgOrderValue',

            'overallGrowthFromLastYear',
            'currentYearOrders',
            'lastYearOrders',

            'recentOrders',
            'topSellingProducts', 
            'orderStatuses',
            'newProducts',
            'monthlyOrderStats',
            'topSellingCategories', 
            'totalOrdersPercentage'
        ));
    }
}
