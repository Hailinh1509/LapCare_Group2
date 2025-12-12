<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\loaisp;

class AdminProductsController extends Controller
{
    // ============================
    //      DANH SÁCH SẢN PHẨM
    // ============================
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('tensp', 'like', "%{$request->search}%");
        }

        $products = $query->orderBy('ngaytao', 'desc')->paginate(10);

        return view('pages.products.index', [
            'title' => 'Tất Cả Sản Phẩm',
            'products' => $products,
            'search' => $request->search ?? ''
        ]);
    }

    // ============================
    //      FORM THÊM
    // ============================
    public function create()
    {
        $loaisp = loaisp::all();
        return view('pages.products.create', [
            'title' => 'Thêm Sản Phẩm',
            'loaisp' => $loaisp
        ]);
    }

    // ============================
    //      XỬ LÝ THÊM
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'masp'      => 'required|unique:sanpham,masp|max:50',
            'tensp'     => 'required|max:255',
            'maloaisp'  => 'required|max:50',
            'soluong'   => 'required|integer|min:0',
            'giasp'     => 'required|numeric|min:0',
            'hinhanh'   => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hang'      => 'required|max:100',
            'thoigian'  => 'required|max:50',
            'mota'      => 'required',
        ], [
            'masp.required' => 'Vui lòng nhập mã sản phẩm.',
            'masp.unique' => 'Mã sản phẩm đã tồn tại.',
            'hinhanh.required' => 'Vui lòng chọn ảnh sản phẩm.',
            'hinhanh.image' => 'File tải lên phải là ảnh.',
            'hang.required'    => 'Vui lòng nhập hãng sản phẩm.',
            'thoigian.required'=> 'Vui lòng nhập thời gian bảo hành.',
            'mota.required'    => 'Vui lòng nhập mô tả sản phẩm.',
        ]);

        $product = new Product();
        $product->masp = $request->masp;
        $product->tensp = $request->tensp;
        $product->maloaisp = $request->maloaisp;
        $product->soluong = $request->soluong;
        $product->giasp = $request->giasp;
        $product->mota = $request->mota;
        $product->manhinh = $request->manhinh;
        $product->ram = $request->ram;
        $product->cpu = $request->cpu;
        $product->ocung = $request->ocung;
        $product->hang = $request->hang;
        $product->thoigian = $request->thoigian;
        $product->khuyenmai = 0; // thêm mới không nhập khuyến mãi

        // --- Upload ảnh lần đầu, tên: masp.extension
        $file = $request->file('hinhanh');
        $extension = $file->getClientOriginalExtension();
        $fileName = $product->masp . '.' . $extension;

        $file->move(public_path('images'), $fileName);

        $product->hinhanh = 'images/' . $fileName;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }



    // ============================
    //       SỬA SẢN PHẨM
    // ============================
    public function edit($masp)
    {
        $product = Product::findOrFail($masp);
        $loaisp = loaisp::all();

        return view('pages.products.edit', [
        'title' => 'Sửa Sản Phẩm',
        'product' => $product,
        'loaisp' => $loaisp
    ]);
    }

    public function update(Request $request, $masp)
    {
        $request->validate([
            'tensp' => 'required|max:255',
            'maloaisp' => 'required|max:50',
            'soluong' => 'required|integer|min:0',
            'giasp' => 'required|numeric|min:0',
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($masp);

        $product->tensp = $request->tensp;
        $product->maloaisp = $request->maloaisp;
        $product->soluong = $request->soluong;
        $product->giasp = $request->giasp;
        $product->mota = $request->mota;
        $product->manhinh = $request->manhinh;
        $product->ram = $request->ram;
        $product->cpu = $request->cpu;
        $product->ocung = $request->ocung;
        $product->hang = $request->hang;
        $product->thoigian = $request->thoigian;
        $product->khuyenmai = $request->khuyenmai ?? 0;

        // Upload ảnh mới và ghi đè file cũ
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $extension = $file->getClientOriginalExtension();
            $filename = $product->masp . '.' . $extension;
            $file->move(public_path('images'), $filename);
            $product->hinhanh = 'images/' . $filename;
        }

        $product->save();

        return redirect()->route('products.index')
                         ->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // ============================
    //      XÓA
    // ============================
    public function delete($masp)
    {
        $product = Product::find($masp);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại!');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}