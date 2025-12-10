@extends('layouts.admin')

@section('content')

<style>
table thead.custom-header th {
    background-color: #9a4b91ff !important;
    color: #fff !important;
    text-align: center;
}
.text-center-cell {
    text-align: center;
    vertical-align: middle;
}
.col-action {
    min-width: 100px;
    white-space: nowrap;
}
</style>

<div class="container-fluid">

    <!-- TIM KIEM -->
    <form method="GET" action="{{ route('reviews.index') }}" class="mb-3">
        <div class="input-group" style="max-width:400px">
            <input type="text" name="search" class="form-control"
                   placeholder="Tìm khách hàng hoặc sản phẩm..."
                   value="{{ $search }}">
            <button class="btn btn-primary">Tìm</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead class="custom-header">
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Sao</th>
                    <th>Ngày</th>
                    <th>Thao tác</th>
                </tr>
                </thead>

                <tbody>
                @foreach($reviews as $r)
                <tr>
                    <td class="text-center-cell">{{ $loop->iteration }}</td>
                    <td>{{ $r->user->name ?? 'Không có' }}</td>
                    <td>{{ $r->sanpham->tensp ?? 'Không có' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($r->noidung, 100) }}</td>
                    <td class="text-center-cell">
                        @for($i=1;$i<=5;$i++)
                            <i class="fa {{ $i <= $r->rating ? 'fa-star text-warning' : 'fa-star-o' }}"></i>
                        @endfor
                    </td>
                    <td class="text-center-cell">{{ $r->ngaytao }}</td>
                    <td class="text-center-cell">
                        <form method="POST" action="{{ route('reviews.delete', $r->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xoá đánh giá?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($reviews->isEmpty())
                <tr>
                    <td colspan="7" class="text-center text-danger">Không có đánh giá</td>
                </tr>
                @endif
                </tbody>
            </table>

            <div class="mt-3">
                {{ $reviews->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

@endsection
