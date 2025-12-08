@extends('pages.accounts.layout')

@section('title', 'Cập nhật thông tin')

@section('account-content')
<h3>Cập nhật thông tin khách hàng</h3>
<hr>

{{-- Hiển thị thông báo success --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Hiển thị thông báo lỗi validation --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('accounts.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Họ và tên</label>
        <input type="text" class="form-control" id="name" name="name" 
               value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" 
               value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="sdt" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="sdt" name="sdt" 
               value="{{ old('sdt', $user->sdt) }}">
    </div>

    <div class="mb-3">
        <label for="diachi" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="diachi" name="diachi" 
               value="{{ old('diachi', $user->diachi) }}">
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
