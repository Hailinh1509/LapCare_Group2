@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h2 class="text-success fw-bold mb-3">Đặt hàng thành công!</h2>

    <p>Cảm ơn bạn đã đặt hàng tại LapCare ❤️</p>
    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Quay về trang chủ</a>
</div>
@endsection
