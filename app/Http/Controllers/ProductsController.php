<?php
//TRANG HIỂN THỊ SẢN PHẨM CỦA QUỲNH ANH
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sanpham;

class ProductsController extends Controller
{
    public function index(Request $request)
{
    $query = Sanpham::query();

    // RAM
    if ($request->ram) {
        $query->where('ram', $request->ram);
    }

    // Màn hình
    if ($request->manhinh) {
        $query->where('manhinh', $request->manhinh);
    }

    // Ổ cứng gom nhóm
    if ($request->ocung == '512GB') {
        $query->where('ocung', 'LIKE', '%512%');
    }
    if ($request->ocung == '1TB') {
        $query->where('ocung', 'LIKE', '%1TB%');
    }

    // Giá
    if ($request->price_from) {
        $query->where('giasp', '>=', $request->price_from);
    }
    if ($request->price_to) {
        $query->where('giasp', '<=', $request->price_to);
    }

    $products = $query->paginate(12);

    // danh sách brand
    $brands = Sanpham::whereNotNull('hang')
                ->pluck('hang')
                ->unique()
                ->values();

    // RAM
    $ramOptions = Sanpham::whereNotNull('ram')
                    ->pluck('ram')
                    ->unique()
                    ->filter(fn($i) => in_array($i, ['16GB', '8GB']))
                    ->values();

    // Màn hình
    $manhinhOptions = Sanpham::whereNotNull('manhinh')
                        ->pluck('manhinh')
                        ->unique()
                        ->filter(fn($i) => in_array($i, [
                            '14 inches','15.6 inches','16 inches'
                        ]))
                        ->values();

    // Ổ cứng
    $ocungOptions = ['512GB','1TB'];

return view('pages.products.products', compact(
    'products','brands','ramOptions','manhinhOptions','ocungOptions'
));

}

}
