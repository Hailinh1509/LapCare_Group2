@extends('layouts.admin')

@section('content')
<style>
    .table thead th {
        background-color: #1101c8ff !important;
        color: white !important;
         text-align: center !important;
         font-size: 16px !important; 
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách nhân viên</h3>
    </div>

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
    @foreach($employees as $emp)
    <tr>
        <td>{{ $emp->manv }}</td>
        <td>{{ $emp->tennv }}</td>
        <td>{{ $emp->sdt }}</td>
        <td>{{ $emp->gmail }}</td>
        <td>{{ $emp->diachi }}</td>
        <td>{{ $emp->vaitro->tenvt ?? 'Không có' }}</td>
        

                
                <td class="text-center">
                    <a href="{{ route('employees.edit', $emp->manv) }}" class="btn btn-warning btn-sm">
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
