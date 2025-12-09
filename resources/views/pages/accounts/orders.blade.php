@extends('pages.accounts.layout')

@section('title', 'Danh sách đơn hàng')

@section('account-content')
<style>
    .account-title {
        font-size: 22px;
        font-weight: 700;
        color: #4B0082;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }
    .orders-table * {
        font-size: 13px !important;
    }
    .orders-table th {
        white-space: nowrap;
        padding: 6px 0px !important;
    }
    .orders-table td {
        padding: 6px 8px !important;
    }
    .orders-badge {
        font-size: 10px !important;
        padding: 3px 6px !important;
    }
    .orders-btn {
        padding: 3px 8px !important;
        font-size: 10px !important;
        color: #4B0082 !important;
        background-color: #e7dbff !important;
        border: 1px solid #4B0082 !important;
        border-radius: 6px !important;
        font-weight: 600;
    }
    .orders-btn:hover {
        background-color: #4B0082 !important;
        color: white !important;
    }

</style>

<div class="container-fluid">
    <div class="card" style="border: none; box-shadow: none;">
        <div class="card-header text-white" style=" padding: 8px 14px;">
            <h5 class="account-title mb-0" style="font-size: 18px;">Danh Sách Đơn Hàng</h5>
        </div>

        <div class="card-body" style="padding: 8px 14px;">

            @if(session('success'))
                <div class="alert alert-success py-2" style="font-size: 13px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle orders-table">
                    <thead class="table-light text-center fw-bold">
                        <tr>
                            <th>Mã ĐH</th>
                            <th>Ngày đặt</th>
                            <th>Phí VC</th>
                            <th>VAT</th>
                            <th>Tổng tiền</th>
                            <th>PTTT</th>
                            <th>TT thanh toán</th>
                            <th>TT vận chuyển</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="text-center">{{ $order->madh }}</td>

                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($order->ngaydat)->format('d/m/Y') }}
                            </td>

                            <td class="text-end">
                                {{ number_format($order->phivanchuyen, 0, ',', '.') }} đ
                            </td>

                            <td class="text-end">
                                {{ number_format($order->VAT, 0, ',', '.') }} đ
                            </td>

                            <td class="text-end">
                                {{ number_format($order->tongtien, 0, ',', '.') }} đ
                            </td>

                            <td class="text-center">{{ $order->pttt }}</td>

                            <td class="text-center">
                                <span class="badge orders-badge bg-{{ $order->ttthanhtoan == 'Đã thanh toán' ? 'success' : 'warning' }}">
                                    {{ $order->ttthanhtoan }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge orders-badge bg-{{ $order->ttvanchuyen == 'Đã giao' ? 'success' : 'secondary' }}">
                                    {{ $order->ttvanchuyen }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('accounts.detailed_orders', $order->madh) }}"
                                class="btn orders-btn">
                                    Chi Tiết
                                </a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted" style="padding: 12px;">
                                Chưa có đơn hàng nào.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
