@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header text-white" style="background-color: #9a4b91ff;">
            Sửa Nhà Cung Cấp
        </div>
        <div class="card-body" style="background-color: #f5f5f7;">
            <form action="{{ route('suppliers.update', $ncc->mancc) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="mancc" class="form-label">Mã NCC</label>
                    <input type="text" value="{{ $ncc->mancc }}" class="form-control" disabled>
                </div>

                <div class="mb-3">
                    <label for="tenncc" class="form-label">Tên NCC</label>
                    <input type="text" name="tenncc" id="tenncc" value="{{ $ncc->tenncc }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="sdt" class="form-label">SĐT</label>
                    <input type="text" name="sdt" id="sdt" value="{{ $ncc->sdt }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="gmail" class="form-label">Gmail</label>
                    <input type="email" name="gmail" id="gmail" value="{{ $ncc->gmail }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="diachi" class="form-label">Địa Chỉ</label>
                    <input type="text" name="diachi" id="diachi" value="{{ $ncc->diachi }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
