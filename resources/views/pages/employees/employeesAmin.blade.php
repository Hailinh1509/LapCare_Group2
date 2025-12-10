@extends('layouts.admin')

@section('content')

<style>
    .table thead th {
        background-color: #1101c8ff !important;
        color: white !important;
        text-align: center !important;
        font-size: 16px !important; 
    }

    .btn-viewall {
        background:#1101c8ff;
        border:none;
        height:40px;
        display:flex;
        align-items:center;
        color:white;
        padding: 0 15px;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-viewall:hover {
        background:#3c2bff;
        color:white;
        text-decoration: none;
    }
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách nhân viên</h3></a>
    </div>

    {{-- Thanh tìm kiếm + xem tất cả --}}
    <div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 100%;">

        <form action="{{ route('employees.search') }}" method="GET" 
              class="d-flex" style="max-width: 380px;">
            <input type="text" name="keyword" class="form-control"
                   placeholder="Tìm nhân viên theo tên..." required
                   style="border-radius: 8px 0 0 8px;">

            <button class="btn btn-primary"
                    style="background:#1101c8ff; border:none; border-radius:0 8px 8px 0;">
                Tìm
            </button>
        </form>

        <a href="{{ route('employees.index') }}" class="btn-viewall">
            Xem tất cả
        </a>

    </div>

    {{-- BẢNG NHÂN VIÊN --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên nhân viên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Vai trò</th>
                <th width="120">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @forelse($employees as $emp)
            <tr>
                <td>{{ $emp->id }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->sdt }}</td>
                <td>{{ $emp->diachi }}</td>
                <td><span class="badge bg-primary">Nhân viên</span></td>

                <td class="text-center">
                    <a href="{{ route('employees.edit', $emp->id) }}" 
                       class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('employees.destroy', $emp->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Bạn chắc chắn muốn xoá nhân viên này?')"
                                class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="7" class="text-center text-danger">
                    Không tìm thấy dữ liệu.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
