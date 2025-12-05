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
        <h3>Danh sách khách hàng</h3>
    </div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mã KH</th>
            <th>Tên</th>
            <th>SDT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
         
            <th width="120">Thao tác</th>
        </tr>
    </thead>

<tbody>
    @foreach($customers as $cus)
    <tr>
        <td>{{ $cus->matk }}</td>
        <td>{{ $cus->tentk }}</td>
        <td>{{ $cus->sdt }}</td>
        <td>{{ $cus->gmail }}</td>
        <td>{{ $cus->diachi }}</td>
        
        

                
                <td class="text-center">
                    <a href="{{ route('customers.edit', $cus->matk) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>

                    <form action="{{ route('customers.destroy', $cus->matk) }}"
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
