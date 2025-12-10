@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Thêm đơn nhập mới</h3>

    <form action="{{ route('imports.store') }}" method="POST">
        @csrf

        {{-- Mã đơn nhập --}}
        <div class="mb-3">
            <label class="form-label">Mã đơn nhập</label>
            <input type="text" name="madn" class="form-control" required placeholder="VD: DN003">
        </div>

        {{-- Nhà cung cấp --}}
        <div class="mb-3">
            <label class="form-label">Nhà cung cấp</label>
            <select name="mancc" class="form-select" required>
                <option value="">-- Chọn nhà cung cấp --</option>
                @foreach($suppliers as $s)
                    <option value="{{ $s->mancc }}">{{ $s->tenncc }}</option>
                @endforeach
            </select>
        </div>

        <hr>
        <h5>Sản phẩm nhập</h5>

        <div id="product-area">

            {{-- 1 dòng sản phẩm --}}
            <div class="row g-3 mb-2 item-row">
                <div class="col-md-4">
                    <select name="items[0][masp]" class="form-select" required>
                        <option value="">-- Chọn sản phẩm --</option>
                        @foreach($products as $p)
                            <option value="{{ $p->masp }}">{{ $p->tensp }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="number" name="items[0][soluong]" class="form-control"
                           placeholder="Số lượng" min="1" required>
                </div>

                <div class="col-md-3">
                    <input type="number" name="items[0][gianhap]" class="form-control"
                           placeholder="Giá nhập" min="0" required>
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100 remove-row">Xóa</button>
                </div>
            </div>

        </div>

        <button type="button" id="addRow" class="btn btn-secondary mb-3">+ Thêm sản phẩm</button>

        <br>
        <button type="submit" class="btn btn-primary">Lưu đơn nhập</button>
        <a href="{{ route('imports.index') }}" class="btn btn-warning">Hủy</a>
    </form>
</div>

{{-- Script thêm dòng sản phẩm --}}
<script>
let index = 1;

document.getElementById('addRow').addEventListener('click', function () {
    let html = `
        <div class="row g-3 mb-2 item-row">
            <div class="col-md-4">
                <select name="items[${index}][masp]" class="form-select" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->masp }}">{{ $p->tensp }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="number" name="items[${index}][soluong]" class="form-control"
                       placeholder="Số lượng" min="1" required>
            </div>

            <div class="col-md-3">
                <input type="number" name="items[${index}][gianhap]" class="form-control"
                       placeholder="Giá nhập" min="0" required>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100 remove-row">Xóa</button>
            </div>
        </div>
    `;
    document.getElementById('product-area').insertAdjacentHTML('beforeend', html);
    index++;
});

// Xóa dòng sản phẩm
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('.item-row').remove();
    }
});
</script>

@endsection
