<?php

// app/Http/Controllers/SalesReportController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class SalesReportController extends Controller
{
    public function index()
    {
        // Mengambil semua data orders dari database
        $orders = Order::all();

        // Mengelompokkan data orders berdasarkan nama produk dan tanggal
        $salesReports = $orders->groupBy(function($order) {
            return $order->order_number; // Atau gunakan product_name jika tersedia
        })->map(function($groupedOrders) {
            return [
                'order_number' => $groupedOrders->first()->order_number,
                'total_revenue' => $groupedOrders->sum('total_amount'),
                'quantity_sold' => $groupedOrders->sum('quantity'),
                'sale_date' => $groupedOrders->first()->created_at->toDateString(),
            ];
        });

        return view('owner.sales-reports', ['salesReports' => $salesReports]);
    }
}

