<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\LoaiSP;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // ---------- LỌC THEO LOẠI SẢN PHẨM (maloaisp) ----------
        if ($request->filled('maloaisp')) {
            $maloaisp = (array) $request->maloaisp;
            $query->whereIn('maloaisp', $maloaisp);
        }

        // ---------- LỌC THEO THƯƠNG HIỆU ----------
        if ($request->filled('brand')) {
            $brands = (array) $request->brand;
            $query->whereIn('hang', $brands);
        }

        // ---------- LỌC THEO RAM ----------
        if ($request->filled('ram')) {
            $rams = (array) $request->ram;
            $query->where(function ($q) use ($rams) {
                foreach ($rams as $r) {
                    $q->orWhere('ram', 'LIKE', '%' . addcslashes(trim($r), '%_') . '%');
                }
            });
        }

        // ---------- LỌC THEO Ổ CỨNG ----------
        if ($request->filled('ocung')) {
            $ocungs = (array) $request->ocung;
            $query->where(function ($q) use ($ocungs) {
                foreach ($ocungs as $o) {
                    $q->orWhere('ocung', 'LIKE', '%' . addcslashes(trim($o), '%_') . '%');
                }
            });
        }

        // ---------- LỌC THEO MÀN HÌNH ----------
        if ($request->filled('manhinh')) {
            $manhinhs = (array) $request->manhinh;
            $query->where(function ($q) use ($manhinhs) {
                foreach ($manhinhs as $mh) {
                    $q->orWhere('manhinh', 'LIKE', '%' . addcslashes(trim($mh), '%_') . '%');
                }
            });
        }

        // ---------- KHOẢNG GIÁ ----------
        if ($request->filled('price_from')) {
            $query->where('giasp', '>=', (float) $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('giasp', '<=', (float) $request->price_to);
        }

        // ---------- SẮP XẾP ----------
        if ($request->sort == 'low') {
            $query->orderBy('giasp', 'asc');
        } elseif ($request->sort == 'high') {
            $query->orderBy('giasp', 'desc');
        } elseif ($request->sort == 'sale') {
            $query->orderBy('khuyenmai', 'desc');
        }

        // ---------- PHÂN TRANG ----------
        $products = $query->paginate(12)->appends($request->all());


        /* ==========================================================
           DỮ LIỆU FILTER – TỰ ĐỘNG GOM GỌN TỪ DATABASE
        ========================================================== */

        // Thương hiệu
        $brands = Product::pluck('hang')->filter()->unique()->values();

        // RAM
        $ramOptions = Product::pluck('ram')->map(function ($v) {
            return trim($v);
        })->filter()->unique()->values();

        // Màn hình
        $manhinhOptions = Product::pluck('manhinh')->map(function ($v) {
            return trim($v);
        })->filter()->unique()->values();

        // Ổ cứng – RÚT GỌN CHỈ CÒN 512GB / 1TB / 256GB...
        $ocungOptions = Product::pluck('ocung')
            ->map(function ($v) {
                if (!$v) return null;

                // Regex tách 512GB, 256GB, 1TB,...
                if (preg_match('/(\d+(?:GB|TB))/', $v, $matches)) {
                    return $matches[1];
                }
                return null;
            })
            ->filter()
            ->unique()
            ->values();

        // Loại sản phẩm
        $loaisp = LoaiSP::select('maloaisp', 'tenloaisp')->get();

        return view(
            'pages.products.products',
            compact('products', 'brands', 'ramOptions', 'manhinhOptions', 'ocungOptions', 'loaisp')
        );
    }
}
