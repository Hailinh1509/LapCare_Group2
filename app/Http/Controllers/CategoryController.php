<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\loaisp;
class CategoryController extends Controller
{
    public function index()
    {
        // Lấy danh sách loại sản phẩm + số lượng sản phẩm mỗi loại
        $categories = DB::table('loaisp as l')
    ->leftJoin('sanpham as s', 'l.maloaisp', '=', 's.maloaisp')
    ->select(
        'l.maloaisp',
        'l.tenloaisp',
        DB::raw('DATE(l.ngaytao) as ngaytao'),
        DB::raw('DATE(l.ngaysua) as ngaysua'),
        DB::raw('COUNT(s.masp) as soluong_sanpham')
    )
    ->groupBy('l.maloaisp', 'l.tenloaisp', 'l.ngaytao', 'l.ngaysua')
    ->orderBy('l.maloaisp', 'asc')
    ->get();

        return view('pages.categories.index', [
            'title' => 'Danh sách loại sản phẩm',
            'categories' => $categories
        ]);
    }
    public function search(Request $request)
{
    $keyword = $request->keyword;

    $categories = DB::table('loaisp as l')
        ->leftJoin('sanpham as s', 'l.maloaisp', '=', 's.maloaisp')
        ->select(
            'l.maloaisp',
            'l.tenloaisp',
            DB::raw('DATE(l.ngaytao) as ngaytao'),
            'l.ngaysua',
            DB::raw('COUNT(s.masp) as soluong_sanpham')
        )
        ->where('l.tenloaisp', 'like', "%$keyword%")
        ->groupBy('l.maloaisp', 'l.tenloaisp', 'l.ngaytao', 'l.ngaysua')
        ->orderBy('l.maloaisp', 'asc')
        ->get();

    return view('pages.categories.index', [
        'title' => 'Kết quả tìm kiếm',
        'categories' => $categories,
        'keyword' => $keyword
    ]);
}
public function create()
    {
        return view('pages.categories.create');
    }

    // Nhận dữ liệu từ form và lưu DB
    public function store(Request $request)
    {
        $request->validate([
            'maloaisp' => 'required|max:5',
            'tenloaisp' => 'required|max:255'
        ]);

        loaisp::create([
            'maloaisp' => $request->maloaisp,
            'tenloaisp' => $request->tenloaisp,
            'ngaytao' => now(),
        ]);

        return redirect()->route('categories.index')
                         ->with('success', 'Thêm danh mục thành công!');
    }
}

