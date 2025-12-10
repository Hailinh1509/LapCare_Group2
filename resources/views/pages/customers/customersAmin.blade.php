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
        <h3>Danh sách khách hàng</h3>
    </div>

 <div class="d-flex justify-content-between align-items-center mb-4" style="max-width: 100%;">
    
    {{-- Thanh tìm kiếm --}}
    <form action="{{ route('customers.search') }}" method="GET" 
          class="d-flex" style="max-width: 380px;">    
        <input type="text" name="keyword" class="form-control"
               placeholder="Tìm khách hàng theo tên..." required
               style="border-radius: 8px 0 0 8px;">

        <button class="btn btn-primary"
                style="background:#1101c8ff; border:none; border-radius:0 8px 8px 0;">
            Tìm
        </button>
    </form>

    {{-- Nút xem tất cả --}}
<a href="{{ route('customers.index') }}" class="btn-viewall">
    Xem tất cả
</a>


</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mã KH</th>
            <th>Họ và Tên</th>
            <th>SDT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
         
            
        </tr>
    </thead>

<tbody>
    @foreach($customers as $cus)
    <tr>
        <td>{{ $cus->matk }}</td>
        <td>{{ $cus->name }}</td>
        <td>{{ $cus->sdt }}</td>
        <td>{{ $cus->email }}</td>
        <td>{{ $cus->diachi }}</td>
        
        
 
                

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
