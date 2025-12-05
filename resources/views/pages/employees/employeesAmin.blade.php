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
      text-decoration: none; /
}

/* Khi hover đổi sang tím nhạt hơn */
.btn-viewall:hover {
    background:#3c2bff;
    color:white;
      text-decoration: none; 
}
</style>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách nhân viên</h3>
    </div>

 <div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 100%;">
    
    {{-- Thanh tìm kiếm --}}
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

    {{-- Nút xem tất cả --}}
<a href="{{ route('employees.index') }}" class="btn-viewall">
    Xem tất cả
</a>


</div>


    {{-- BẢNG DANH SÁCH NHÂN VIÊN --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Chức vụ</th>
                <th width="120">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @forelse($employees as $emp)
            <tr>
                <td>{{ $emp->manv }}</td>
                <td>{{ $emp->tennv }}</td>
                <td>{{ $emp->sdt }}</td>
                <td>{{ $emp->gmail }}</td>
                <td>{{ $emp->diachi }}</td>
                <td>{{ $emp->vaitro->tenvt ?? 'Không có' }}</td>

                <td class="text-center">
                    <a href="{{ route('employees.edit', $emp->manv) }}" 
                       class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('employees.destroy', $emp->manv) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Bạn chắc chắn muốn xoá?')"
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
