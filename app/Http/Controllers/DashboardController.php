<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;   // nhớ import

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        // 1. Doanh thu hôm nay (tạm tính = sum(soluong * dongia) các đơn có ngaydat = hôm nay)
        $totalRevenueToday = DB::table('chitietdonhang')
            ->join('donhang', 'chitietdonhang.mahd', '=', 'donhang.madh')
            ->whereDate('donhang.ngaydat', $today)
            ->sum(DB::raw('chitietdonhang.soluong * chitietdonhang.dongia'));

        // 2. Số đơn hàng hôm nay
        $ordersToday = DB::table('donhang')
            ->whereDate('ngaydat', $today)
            ->count();

        // 3. Top 5 sản phẩm bán chạy
        
$topProducts = DB::table('chitietdonhang')
    ->join('sanpham', 'chitietdonhang.masp', '=', 'sanpham.masp')
    ->select(
        'sanpham.masp',
        'sanpham.tensp',
        DB::raw('SUM(chitietdonhang.soluong) AS total_sold') // alias phải là total_sold
    )
    ->groupBy('sanpham.masp', 'sanpham.tensp')
    ->orderByDesc('total_sold')
    ->limit(5)
    ->get();

            // Lấy sản phẩm bán chạy nhất để hiển thị ở ô to
        $bestProduct = $topProducts->first();
        $bestProductName = $bestProduct->tensp ?? 'Chưa có dữ liệu';
        $bestProductQty  = $bestProduct->total_sold ?? 0;
        
        // 4. Sản phẩm sắp hết hàng (ví dụ: số lượng < 10)
        $lowStockProducts = DB::table('sanpham')
            ->where('soluong', '<', 10)
            ->orderBy('soluong', 'asc')
            ->limit(5)
            ->get();

        // 5. Top khách hàng (dựa theo tổng tiền đã mua)
$topCustomers = DB::table('donhang')
    ->join('users', DB::raw('CONVERT(donhang.matk USING utf8mb4)'), '=', DB::raw('CONVERT(users.matk USING utf8mb4)'))
    ->leftJoin('chitietdonhang', 'donhang.madh', '=', 'chitietdonhang.mahd')
    ->select(
        'users.id',
        'users.name',
        DB::raw('COUNT(DISTINCT donhang.madh) AS total_orders'),   // ĐỔI TÊN ALIAS Ở ĐÂY
        DB::raw('COALESCE(SUM(chitietdonhang.soluong * chitietdonhang.dongia),0) AS total_spent')
    )
    ->groupBy('users.id', 'users.name')
    ->orderByDesc('total_spent')
    ->limit(5)
    ->get();

$bestCustomer = $topCustomers->first();
$bestCustomerName   = $bestCustomer->name ?? 'Chưa có dữ liệu';
$bestCustomerSpent  = $bestCustomer->total_spent ?? 0;

// 6. Doanh thu theo tháng trong năm hiện tại
        $currentYear = Carbon::now()->year;

        $monthlyRevenue = DB::table('chitietdonhang')
            ->join('donhang', 'chitietdonhang.mahd', '=', 'donhang.madh')
            ->select(
                DB::raw('MONTH(donhang.ngaydat) AS month'),
                DB::raw('SUM(chitietdonhang.soluong * chitietdonhang.dongia) AS total')
            )
            ->whereYear('donhang.ngaydat', $currentYear)
            ->groupBy(DB::raw('MONTH(donhang.ngaydat)'))
            ->pluck('total', 'month'); // collection [tháng => tổng tiền]

       // 7. Số lượng hàng thực bán 7 ngày gần nhất
    // Tính khoảng thời gian: từ hôm nay lùi 6 ngày -> hôm nay (tổng 7 ngày)
    $toDate   = Carbon::today()->toDateString();              // yyyy-mm-dd
    $fromDate = Carbon::today()->subDays(6)->toDateString();  // yyyy-mm-dd

    $realSold = DB::table('chitietdonhang')
        ->join('donhang', 'chitietdonhang.mahd', '=', 'donhang.madh')
        ->join('sanpham', 'chitietdonhang.masp', '=', 'sanpham.masp')
        ->select(
            'sanpham.masp',
            'sanpham.tensp',
            DB::raw('SUM(chitietdonhang.soluong) AS qty_sold')   // alias số lượng bán
        )
        ->whereBetween(DB::raw('DATE(donhang.ngaydat)'), [$fromDate, $toDate])
        ->groupBy('sanpham.masp', 'sanpham.tensp')
        ->orderByDesc('qty_sold')
        ->get();
         
        // Chuẩn bị dữ liệu cho Chart.js (đủ 12 tháng)
        $monthLabels = [];
        $monthValues = [];

        for ($m = 1; $m <= 12; $m++) {
            $monthLabels[] = 'Tháng ' . $m;
            $monthValues[] = (float)($monthlyRevenue[$m] ?? 0);
        }

               return view('dashboard', compact(
        'totalRevenueToday',
        'ordersToday',
        'topProducts',
        'lowStockProducts',
        'topCustomers',
        'currentYear',
        'monthLabels',
        'monthValues',
        'fromDate',
        'toDate',
        'realSold'
    ));



    }
}
