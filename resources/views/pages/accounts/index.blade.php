@extends('pages.accounts.layout')

@section('title', 'Thông tin khách hàng')

@section('account-content')
<h3>Thông tin khách hàng</h3>
<hr>

<div class="row">
    <div class="col-md-6 mb-3">
        <strong>Họ và tên:</strong> {{ $user->name }}
    </div>
    <div class="col-md-6 mb-3">
        <strong>Email:</strong> {{ $user->email }}
    </div>
    <div class="col-md-6 mb-3">
        <strong>Số điện thoại:</strong> {{ $user->sdt ?? 'Chưa cập nhật' }}
    </div>
    <div class="col-md-6 mb-3">
        <strong>Địa chỉ:</strong> {{ $user->diachi ?? 'Chưa cập nhật' }}
    </div>
</div>

<a href="{{ route('accounts.edit') }}" class="btn btn-primary mt-3">
    Cập nhật thông tin
</a>
@endsection
