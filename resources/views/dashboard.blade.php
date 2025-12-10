@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        {{-- TIÊU ĐỀ --}}
        <h3 class="fw-bold mb-1">Dashboard thống kê</h3>
        <p class="text-muted mb-4">Tổng quan hoạt động kinh doanh của Lapcare</p>

        {{-- 1. 4 Ô THỐNG KÊ NHANH --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted text-uppercase small mb-1">Doanh thu hôm nay</p>
                        <h4 class="fw-bold mb-0">
                            {{ number_format($totalRevenueToday, 0, ',', '.') }} đ
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted text-uppercase small mb-1">Số đơn hàng hôm nay</p>
                        <h4 class="fw-bold mb-0">
                            {{ $ordersToday }}
                        </h4>
                    </div>
                </div>
            </div>

            @php
                $bestProduct = $topProducts->first();
                $bestProductName = $bestProduct->tensp ?? 'Chưa có dữ liệu';
                $bestProductQty  = $bestProduct->total_sold ?? 0;

                $bestCustomer = $topCustomers->first();
                $bestCustomerName  = $bestCustomer->name ?? 'Chưa có dữ liệu';
                $bestCustomerSpent = $bestCustomer->total_spent ?? 0;
            @endphp

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted text-uppercase small mb-1">SP bán chạy nhất</p>
                        <div class="fw-semibold mb-1" style="min-height: 38px;">
                            {{ $bestProductName }}
                        </div>
                        <small class="text-muted">
                            SL bán: <span class="fw-bold text-dark">{{ $bestProductQty }}</span>
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted text-uppercase small mb-1">KH chi nhiều nhất</p>
                        <div class="fw-semibold mb-1" style="min-height: 38px;">
                            {{ $bestCustomerName }}
                        </div>
                        <small class="text-muted">
                            Tổng chi:
                            <span class="fw-bold text-dark">
                                {{ number_format($bestCustomerSpent, 0, ',', '.') }} đ
                            </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. BIỂU ĐỒ DOANH THU THEO THÁNG --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0">Doanh thu theo tháng ({{ $currentYear }})</h5>
                    <small class="text-muted">
                        Tổng doanh thu các đơn hàng theo từng tháng trong năm.
                    </small>
                </div>
                <canvas id="revenueChart" height="90"></canvas>
            </div>
        </div>

        {{-- 3. 3 BẢNG: TOP SP, SẮP HẾT HÀNG, KHÁCH HÀNG --}}
        <div class="row g-3 mb-4">
            {{-- Top SP bán chạy --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2">Top sản phẩm bán chạy</h6>
                        <small class="text-muted d-block mb-3">
                            Dựa theo tổng số lượng đã bán.
                        </small>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead>
                                <tr class="text-muted small">
                                    <th>Tên sản phẩm</th>
                                    <th class="text-end">SL bán</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($topProducts as $item)
                                    <tr>
                                        <td>{{ $item->tensp }}</td>
                                        <td class="text-end fw-semibold">{{ $item->total_sold }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted small">
                                            Chưa có dữ liệu.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SP sắp hết hàng --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2">Sản phẩm sắp hết hàng</h6>
                        <small class="text-muted d-block mb-3">
                            Ưu tiên theo số lượng tồn kho thấp.
                        </small>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead>
                                <tr class="text-muted small">
                                    <th>Mã</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="text-end">Tồn kho</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($lowStockProducts as $item)
                                    <tr>
                                        <td class="small">{{ $item->masp }}</td>
                                        <td>{{ $item->tensp }}</td>
                                        <td class="text-end fw-semibold">{{ $item->soluong }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted small">
                                            Chưa có dữ liệu.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Top khách hàng --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2">Top khách hàng</h6>
                        <small class="text-muted d-block mb-3">
                            Dựa theo tổng số tiền đã mua.
                        </small>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead>
                                <tr class="text-muted small">
                                    <th>Khách hàng</th>
                                    <th class="text-end">Số đơn</th>
                                    <th class="text-end">Tổng chi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($topCustomers as $cus)
                                    <tr>
                                        <td>{{ $cus->name }}</td>
                                        <td class="text-end">{{ $cus->total_orders }}</td>
                                        <td class="text-end fw-semibold">
                                            {{ number_format($cus->total_spent, 0, ',', '.') }} đ
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted small">
                                            Chưa có dữ liệu.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. HÀNG THỰC BÁN 7 NGÀY GẦN NHẤT --}}
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-2">
                    Hàng thực bán ({{ $fromDate }} - {{ $toDate }})
                </h6>
                <small class="text-muted d-block mb-3">
                    Tổng số lượng xuất kho theo sản phẩm trong 7 ngày gần nhất.
                </small>

                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <thead>
                        <tr class="text-muted small">
                            <th>Mã</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-end">SL bán</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($realSold as $row)
                            <tr>
                                <td class="small">{{ $row->masp }}</td>
                                <td>{{ $row->tensp }}</td>
                                <td class="text-end fw-semibold">
                                    {{ $row->total_sold ?? $row->qty_sold ?? 0 }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted small">
                                    Chưa có dữ liệu.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($monthLabels);
        const values = @json($monthValues);

        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (đ)',
                    data: values,
                    tension: 0.25,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        ticks: {
                            callback: function (value) {
                                return value.toLocaleString('vi-VN');
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
