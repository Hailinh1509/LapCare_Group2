@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Sửa nhân viên</h3>

    <form method="POST" action="{{ route('employees.update', $emp->manv) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Mã NV:</label>
            <input type="text" value="{{ $emp->manv }}" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label>Tên:</label>
            <input type="text" name="tennv" class="form-control"
                   value="{{ $emp->tennv }}" required>
        </div>

        <div class="mb-3">
            <label>SĐT:</label>
            <input type="text" name="sdt" class="form-control"
                   value="{{ $emp->sdt }}" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="gmail" class="form-control"
                   value="{{ $emp->gmail }}" required>
        </div>

        <div class="mb-3">
            <label>Địa chỉ:</label>
            <input type="text" name="diachi" class="form-control"
                   value="{{ $emp->diachi }}" required>
        </div>

        <div class="mb-3">
            <label>Chức vụ:</label>
            <select name="mavt" class="form-control">
                @foreach($roles as $r)
                <option value="{{ $r->mavt }}" 
                    {{ $r->mavt == $emp->mavt ? 'selected' : '' }}>
                    {{ $r->tenvt }}
                </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
