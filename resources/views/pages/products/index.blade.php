@extends('layouts.admin')

@section('content')

<style>
/* ---------- HEADER BẢNG ---------- */
table thead.custom-header th {
    background-color: #994890ff !important; /* xanh lá */
    color: #fff !important;               /* chữ trắng */
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

/* ---------- CĂN GIỮA CELLS ---------- */
.text-center-cell {
    text-align: center !important;
    vertical-align: middle !important;
}

/* ---------- ĐỘ RỘNG CỘT ---------- */
.col-tensp {
    min-width: 250px; 
    max-width: 350px;
    white-space: normal !important;
}

.col-action {
    min-width: 150px;
    white-space: nowrap;
}

.col-mota {
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ---------- HÌNH ẢNH ---------- */
td img {
    width: 60px;
    height: auto;
    border-radius: 5px;
}

/* ---------- MÔ TẢ TOOLTIP ---------- */
.description-cell {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
    position: relative; 
}

.description-cell:hover::after {
    content: attr(title);
    position: absolute;
    top: 50%;
    left: 105%; 
    transform: translateY(-50%);
    background: #fff;
    border: 1px solid #ccc;
    padding: 8px;
    width: 160px;
    white-space: normal;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    z-index: 99999;
}

/* ---------- PHÂN TRANG CĂN TRÁI ---------- */
.pagination {
    justify-content: flex-start !important;
}
</style>

<div class="container-fluid">

    <!-- ---------- FORM TÌM KIẾM ---------- -->
    <form action="{{ route('products.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm theo tên..."
                   value="{{ $search }}">
            <button class="btn btn-primary" type="submit">Tìm</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="custom-header">
                        <tr>
                            <th>Mã Sản Phẩm</th>
                            <th class="col-tensp">Tên Sản Phẩm</th>
                            <th>Mã Loại</th>
                            <th>Hình Ảnh</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Mô Tả</th>
                            <th>Màn Hình</th>
                            <th>RAM</th>
                            <th>CPU</th>
                            <th>Ổ Cứng</th>
                            <th>Hãng</th>
                            <th>Thời Gian BH</th>
                            <th>Ngày Tạo</th>
                            <th>Ngày Sửa</th>
                            <th>Khuyến Mãi</th>
                            <th class="col-action">Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $p)
                        <tr>
                            <td class="text-center-cell">{{ $p->masp }}</td>
                            <td class="col-tensp">{{ $p->tensp }}</td>
                            <td class="text-center-cell">{{ $p->maloaisp }}</td>
                            <td class="text-center-cell col-action">
                                @if($p->hinhanh)
                                    <img src="{{ asset($p->hinhanh) }}" alt="Ảnh SP" style="max-width:80px; max-height:80px;">
                                @else
                                    <span class="text-danger">Không có ảnh</span>
                                @endif
                            </td>
                            <td class="text-center-cell">{{ $p->soluong }}</td>
                            <td class="text-center-cell">${{ number_format($p->giasp) }}</td>
                            <td>
                                <div class="text-truncate description-cell" title="{{ $p->mota }}">
                                    {{ $p->mota }}
                                </div>
                            </td>
                            <td class="text-center-cell">{{ $p->manhinh }}</td>
                            <td class="text-center-cell">{{ $p->ram }}</td>
                            <td class="text-center-cell col-action">{{ $p->cpu }}</td>
                            <td class="text-center-cell">{{ $p->ocung }}</td>
                            <td class="text-center-cell">{{ $p->hang }}</td>
                            <td class="text-center-cell">{{ $p->thoigian }}</td>
                            <td class="col-action">{{ $p->ngaytao }}</td>
                            <td>{{ $p->ngaysua }}</td>
                            <td class="text-center-cell">{{ $p->khuyenmai }}</td>
                            <td class="text-center-cell col-action">
                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Bạn có chắc muốn xóa?')">
                                   <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                <!-- ---------- PHÂN TRANG ---------- -->
                <div class="mt-3">
                    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>
    </div>

</div>

@endsection
