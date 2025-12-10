@extends('pages.accounts.layout')

@section('title', 'Thông tin khách hàng')

@section('account-content')

<style>
    .account-title {
        font-weight: 700;
        font-size: 22px;
        letter-spacing: 1px;
        color: #4B0082;
        margin-bottom: 20px;
    }

    .account-box {
        background: #f8f9fc;
        border: 1px solid #e3e6f0;
        padding: 20px 25px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-top: 10px;
    }

    .account-label {
        font-weight: 600;
        color: #0c0c0cff;
    }

    .account-value {
        color: #060606ff;
        padding-left: 5px;
    }

    .account-box .row div {
        margin-bottom: 18px;
    }

    .btn-custom {
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        background-color: #683989ff !important; /* tím đậm */
        border-color: #4B0082 !important;
        color: white !important;
        transition: 0.2s ease-in-out;
    }

    .btn-custom:hover {
        background-color: #360061 !important;
        border-color: #360061 !important;
    }
</style>

<h3 class="account-title">Thông Tin Khách Hàng</h3>

<div class="account-box">

    <div class="row">
        <div class="col-md-6">
            <span class="account-label">Họ và tên:</span>
            <span class="account-value">{{ $user->name }}</span>
        </div>

        <div class="col-md-6">
            <span class="account-label">Email:</span>
            <span class="account-value">{{ $user->email }}</span>
        </div>

        <div class="col-md-6">
            <span class="account-label">Số điện thoại:</span>
            <span class="account-value">{{ $user->sdt ?? 'Chưa cập nhật' }}</span>
        </div>

        <div class="col-md-6">
            <span class="account-label">Địa chỉ:</span>
            <span class="account-value">{{ $user->diachi ?? 'Chưa cập nhật' }}</span>
        </div>
    </div>

</div>

<a href="{{ route('accounts.edit') }}" class="btn btn-custom mt-3">
    Cập nhật thông tin
</a>

@endsection
