<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /** Danh sách nhân viên */
    public function index()
    {
        $employees = User::where('role', 'admin')->get();

        return view('pages.employees.employeesAmin', compact('employees'), [
            'title' => 'Danh sách nhân viên'
        ]);
    }

    /** Form thêm nhân viên */
    public function create()
    {
        return view('pages.employees.AddEmployeesAdmin');
    }

    /** Lưu nhân viên mới */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'sdt' => 'required',
            'diachi' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
            'role' => 'admin'  // Gán mặc định là NHÂN VIÊN
        ]);

        return redirect()->route('employees.index')->with('success', 'Thêm nhân viên thành công!');
    }

    /** Form sửa nhân viên */
    public function edit($id)
    {
        $emp = User::findOrFail($id);
        return view('pages.employees.UpdateEmployeesAdmin', compact('emp'));
    }

    /** Lưu dữ liệu đã sửa */
    public function update(Request $request, $id)
    {
        $emp = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'sdt' => 'required',
            'diachi' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Nếu người dùng nhập mật khẩu mới → mã hóa lại
        if ($request->password) {
            $emp->password = Hash::make($request->password);
        }

        $emp->update([
            'name' => $request->name,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi
        ]);

        return redirect()->route('employees.index')->with('success', 'Cập nhật thành công!');
    }

    /** Xóa nhân viên */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('employees.index')->with('success', 'Xóa thành công!');
    }

    /** Tìm kiếm nhân viên */
    public function search(Request $request)
    {
        $keyword = strtolower($request->keyword);

        $employees = User::where('role', 'admin')
            ->whereRaw('LOWER(name) LIKE ?', ["%$keyword%"])
            ->get();

        return view('pages.employees.employeesAmin', compact('employees'), [
            'title' => 'Kết quả tìm kiếm'
        ]);
    }
}
