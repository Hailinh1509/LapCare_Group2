@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Thêm nhân viên</h3>

    <form method="POST" action="{{ route('employees.store') }}">
        @csrf

        <div class="mb-3">
            <label>Mã NV:</label>
            <input type="text" name="manv" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tên:</label>
            <input type="text" name="tennv" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>SĐT:</label>
            <input type="text" name="sdt" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="gmail" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Địa chỉ:</label>
            <input type="text" name="diachi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Chức vụ:</label>
            <select name="mavt" class="form-control">
                @foreach($roles as $r)
                <option value="{{ $r->mavt }}">{{ $r->tenvt }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Thêm</button>
    </form>
</div>
@endsection
