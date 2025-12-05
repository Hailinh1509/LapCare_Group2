<?php

namespace App\Http\Controllers;

use App\Models\Nhanvien;
use App\Models\VaiTro;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Nhanvien::with('vaitro')->get();
        return view('pages.employees.employeesAmin', compact('employees'),
        ['title' => 'Tài khoản nhân viên']);
    }

    public function create()
    {
        $roles = VaiTro::all();  // <-- QUAN TRỌNG!!!
        return view('pages.employees.AddEmployeesAdmin', compact('roles'));
    }

    public function store(Request $request)
    {
        Nhanvien::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $emp = Nhanvien::findOrFail($id);
        $roles = VaiTro::all();  // để chọn chức vụ khi edit
        return view('pages.employees.UpdateEmployeesAdmin', compact('emp', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $emp = Nhanvien::findOrFail($id);
        $emp->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        Nhanvien::destroy($id);
        return redirect()->route('employees.index')->with('success', 'Xóa thành công');
    }
    public function search(Request $request)
{
    $keyword = strtolower($request->input('keyword'));

    $employees = Nhanvien::whereRaw('LOWER(tennv) LIKE ?', ["%$keyword%"])
                         ->get();

    return view(
        'pages.employees.employeesAmin',
        compact('employees'),
        ['title' => 'Kết quả tìm kiếm']
    );
}

}
