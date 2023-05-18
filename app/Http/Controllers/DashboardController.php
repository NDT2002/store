<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalPrice = Order::sum('total_price');
        $countByCustomer = Order::select('customer_name', DB::raw('COUNT(*) as count'))
            ->groupBy('customer_name')
            ->get();

        $count = $countByCustomer->count();

        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        $data = Order::select(DB::raw('DATE(order_date) AS date, order_type, SUM(total_price) AS revenue'))
            ->whereBetween('order_date', [$startDate, $endDate])
            ->groupBy('date', 'order_type')
            ->orderBy('date')
            ->get();

        $saleLabels = [];
        $saleDataset = [];
        $importLabels = [];
        $importDataset = [];

        foreach ($data as $item) {
            $date = $item->date;
            $orderType = $item->order_type;
            $revenue = $item->revenue;

            if ($orderType == 1) {
                if (!in_array($date, $saleLabels)) {
                    $saleLabels[] = $date;
                }

                $saleDataset[] = $revenue;
            } else {
                if (!in_array($date, $importLabels)) {
                    $importLabels[] = $date;
                }

                $importDataset[] = $revenue;
            }
        }

        $saleChartData = [
            'labels' => $saleLabels,
            'datasets' => [
                [
                    'label' => 'Xuất',
                    'data' => $saleDataset,
                    'fill' => true,
                    'backgroundColor' => 'rgba(0,255,0,1)',
                    'tension' => 0.4,
                    'barPercentage'=>0.2
                ],
            ],
        ];

        $importChartData = [
            'labels' => $importLabels,
            'datasets' => [
                [
                    'label' => 'Nhập',
                    'data' => $importDataset,
                    'fill' => true,
                    'backgroundColor' => 'rgba(255,0,0,1)',
                    'tension' => 0.4,
                    'barPercentage'=>0.2
                ],
            ],
        ];

        $chartOptions = [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
            'plugins'=>[
                'title'=>[
                    'display'=> true,
                    'text'=> 'Biểu đồ dữ liệu trong 7 ngày ' // Đặt tên cho biểu đồ
                ]   
            ]
        ];

        return view('layout.dashboard', compact('totalOrders', 'totalPrice', 'count', 'saleChartData', 'importChartData', 'chartOptions'));
    }
}
