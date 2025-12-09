@extends('pages.accounts.layout')

@section('title', 'Cập nhật thông tin')

@section('account-content')

<style>
    /* Tiêu đề */
    .account-title {
        font-size: 22px;
        font-weight: 700;
        color: #4B0082;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    /* Nhãn label */
    .form-label {
        font-weight: 600;
        color: #4B0082;
    }

    /* Input */
    .form-control {
        border-radius: 8px;
        padding: 10px 12px;
        border: 1px solid #ccc;
    }

    .form-control:focus {
        border-color: #4B0082;
        box-shadow: 0 0 4px rgba(75, 0, 130, 0.4);
    }

    /* Nút */
    .btn-back {
        background-color: #6c757d !important;
        color: #fff !important;
        border: none !important;
        padding: 8px 18px;
        font-weight: 600;
        border-radius: 6px;
    }

    .btn-back:hover {
        background-color: #5a6268 !important;
    }

    .btn-save {
        background-color: #9a4b91ff !important;
        color: #fff !important;
        border: none !important;
        padding: 8px 18px;
        font-weight: 600;
        border-radius: 6px;
    }

    .btn-save:hover {
        background-color: #803d79 !important;
    }
</style>

<h3 class="account-title">Cập Nhật Thông Tin Khách Hàng</h3>

{{-- Thông báo chỉ hiển thị ở edit --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('accounts.update') }}" method="POST" id="updateForm">
    @csrf

    <div class="mb-3">
        <label class="form-label">Họ và tên</label>
        <input type="text" class="form-control" name="name"
               value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email"
               value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" name="sdt"
               value="{{ old('sdt', $user->sdt) }}"
               maxlength="10"
               pattern="[0-9]{10}"
               title="Số điện thoại phải đúng 10 chữ số">
    </div>

    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" name="diachi"
               value="{{ old('diachi', $user->diachi) }}">
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('accounts.index') }}" class="btn btn-back">
            Quay lại
        </a>

        <button type="submit" class="btn btn-save">
            Cập nhật
        </button>
    </div>
</form>

@endsection

@push('scripts')
<script>
    let formIsDirty = false;

    // Theo dõi thay đổi form
    document.querySelectorAll("#updateForm input, #updateForm textarea").forEach(input => {
        input.addEventListener("input", () => formIsDirty = true);
    });

    // Cảnh báo rời trang nếu có thay đổi
    window.addEventListener("beforeunload", function (e) {
        if (formIsDirty) {
            e.preventDefault();
            e.returnValue = "";
        }
    });

    // Khi submit, bỏ flag
    document.getElementById("updateForm").addEventListener("submit", () => formIsDirty = false);

    // Xử lý nút back
    document.querySelector(".btn-back").addEventListener("click", function (e) {
        if (formIsDirty && !confirm("Bạn có thay đổi chưa lưu. Bạn có muốn rời trang?")) {
            e.preventDefault();
        }
    });
</script>
@endpush
