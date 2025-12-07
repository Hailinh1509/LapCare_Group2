<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $nhacc = DB::table('nhacungcap')
            ->when($search, function ($q) use ($search) {
                $q->where('tenncc', 'like', "%$search%");
            })
            ->paginate(10);

        return view('pages.suppliers.index', compact('nhacc', 'search'));
    }

    public function edit($mancc)
    {
        // Chưa làm phần edit nên để tạm
        return "Trang sửa NCC: " . $mancc;
    }

    public function destroy($mancc)
    {
        DB::table('nhacungcap')->where('mancc', $mancc)->delete();

        return redirect()->route('nhacungcap.index')->with('success', 'Xóa thành công!');
    }
}
