<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('tensp', 'like', "%{$search}%");
        }

        // Phân trang 10 sản phẩm/trang
        $products = $query->orderBy('ngaytao', 'desc')->paginate(10);

        return view('pages.products.index', [
            'title' => 'Tất Cả Sản Phẩm',
            'products' => $products,
            'search' => $request->search ?? ''
        ]);
    }

    // ============================
    //       THÊM SẢN PHẨM
    // ============================
    public function create()
    {
        return view('pages.products.create', [
            'title' => 'Thêm Sản Phẩm'
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product();
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
        $product->khuyenmai = $request->khuyenmai;

        // Upload ảnh
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $path = 'images/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/'), $path);
            $product->hinhanh = $path;
        }

        $product->save();

        return redirect()->route('products.index')
                        ->with('success', 'Thêm sản phẩm thành công!');
    }


    // ============================
    //        SỬA SẢN PHẨM
    // ============================
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.products.edit', [
            'title' => 'Sửa Sản Phẩm',
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tensp' => 'required',
            'gia' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'tensp' => $request->tensp,
            'gia' => $request->gia,
            'mota' => $request->mota,
        ]);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // ============================
    //        XÓA SẢN PHẨM
    // ============================
    public function delete($masp)
    {
        // Tìm sản phẩm theo ID
        $product = Product::find($masp);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Sản phẩm không tồn tại!');
        }

        // Xóa sản phẩm
        $product->delete();

        // Chuyển về trang danh sách với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }

}
