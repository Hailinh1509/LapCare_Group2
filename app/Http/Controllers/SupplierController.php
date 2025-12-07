<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhaCungCap;

class SupplierController extends Controller
{
    // Hiển thị danh sách
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = NhaCungCap::query();

        if ($search) {
            $query->where('tenncc', 'like', "%$search%");
        }

        $nhacungcap = $query->orderBy('mancc')->paginate(10);

        return view('pages.suppliers.index', compact('nhacungcap', 'search'));
    }

    // Form thêm
    public function create()
    {
        return view('pages.suppliers.create');
    }

    // Lưu nhà cung cấp mới
    public function store(Request $request)
    {
        $request->validate([
            'mancc' => 'required|unique:nhacungcap',
            'tenncc' => 'required',
            'sdt' => 'nullable',
            'gmail' => 'nullable|email',
            'diachi' => 'nullable',
        ]);

        NhaCungCap::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Thêm nhà cung cấp thành công!');
    }

    // Form sửa
    public function edit($mancc)
    {
        $ncc = NhaCungCap::findOrFail($mancc);
        return view('pages.suppliers.edit', compact('ncc'));
    }

    // Cập nhật nhà cung cấp
    public function update(Request $request, $mancc)
    {
        $request->validate([
            'tenncc' => 'required',
            'sdt' => 'nullable',
            'gmail' => 'nullable|email',
            'diachi' => 'nullable',
        ]);

        $ncc = NhaCungCap::findOrFail($mancc);
        $ncc->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa
    public function delete($mancc)
    {
        $ncc = NhaCungCap::findOrFail($mancc);
        $ncc->delete();

        return redirect()->route('suppliers.index')->with('success', 'Xóa thành công!');
    }
}

