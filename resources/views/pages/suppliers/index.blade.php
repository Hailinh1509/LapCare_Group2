@extends('layouts.admin')

@section('content')

<style>
table thead.custom-header th {
    background-color: #9a4b91ff !important;
    color: #fff !important;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

/* Căn giữa */
.text-center-cell {
    text-align: center !important;
    vertical-align: middle !important;
}


.col-action {
    min-width: 120px;
    white-space: nowrap;
}

.pagination {
    justify-content: flex-start !important;
}
</style>

<div class="container-fluid">

    <!-- Form tìm kiếm -->
    <form action="{{ route('suppliers.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control"
                placeholder="Tìm theo tên nhà cung cấp..."
                value="{{ $search }}">
            <button class="btn btn-primary" type="submit">Tìm</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="custom-header">
                        <tr>
                            <th>Mã NCC</th>
                            <th>Tên NCC</th>
                            <th>SĐT</th>
                            <th>Gmail</th>
                            <th>Địa Chỉ</th>
                            <th class="col-action">Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($nhacungcap as $n)
                        <tr>
                            <td class="text-center-cell">{{ $n->mancc }}</td>
                            <td>{{ $n->tenncc }}</td>
                            <td class="text-center-cell">{{ $n->sdt }}</td>
                            <td>{{ $n->gmail }}</td>
                            <td>{{ $n->diachi }}</td>

                            <!-- Thao tác -->
                            <td class="text-center-cell">
                                <a href="{{ route('suppliers.edit', $n->mancc) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('suppliers.delete', $n->mancc) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="mt-3">
                    {{ $nhacungcap->withQueryString()->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
