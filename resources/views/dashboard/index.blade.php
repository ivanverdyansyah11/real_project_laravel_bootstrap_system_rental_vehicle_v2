@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3 g-lg-4">
            <div class="col">
                <div class="card-menu d-flex align-items-center gap-3">
                    <div class="menu-icon d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="menu-value">
                        <p>Total Customer</p>
                        <h6>{{ $total_customer < 10 ? '0' . $total_customer : $total_customer }}</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-menu d-flex align-items-center gap-3">
                    <div class="menu-icon d-flex align-items-center justify-content-center">
                        <i class="fa-regular fa-id-card"></i>
                    </div>
                    <div class="menu-value">
                        <p>Total Driver</p>
                        <h6>{{ $total_driver < 10 ? '0' . $total_driver : $total_driver }}</h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-menu d-flex align-items-center gap-3">
                    <div class="menu-icon d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                    </div>
                    <div class="menu-value">
                        <p>Total Transaction</p>
                        <h6>{{ $total_transaction < 10 && $total_transaction != 0 ? '0' . $total_transaction : $total_transaction }}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-menu d-flex align-items-center gap-3">
                    <div class="menu-icon d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                    <div class="menu-value">
                        <p>Total {{ auth()->user()->customer ? 'Paid' : 'Income' }}</p>
                        <h6>{{ formatRupiah($total_income) }}</h6>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->check() && auth()->user()->admin)
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card-canvas">
                        <canvas id="myChart" style="height: 420px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('child-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: [
                        @json($data_transaction[1]),
                        @json($data_transaction[2]),
                        @json($data_transaction[3]),
                        @json($data_transaction[4]),
                        @json($data_transaction[5]),
                        @json($data_transaction[6]),
                        @json($data_transaction[7]),
                        @json($data_transaction[8]),
                        @json($data_transaction[9]),
                        @json($data_transaction[10]),
                        @json($data_transaction[11]),
                        @json($data_transaction[12]),
                    ],
                    backgroundColor: [
                        'rgba(189, 150, 72, 1)',
                        'rgba(172, 132, 62, 1)',
                        'rgba(189, 150, 72, 1)',
                        'rgba(172, 132, 62, 1)',
                        'rgba(189, 150, 72, 1)',
                        'rgba(172, 132, 62, 1)',
                        'rgba(189, 150, 72, 1)',
                        'rgba(172, 132, 62, 1)',
                        'rgba(189, 150, 72, 1)',
                        'rgba(172, 132, 62, 1)',
                        'rgba(189, 150, 72, 1)',
                        'rgba(172, 132, 62, 1)',
                    ],
                    borderWidth: 1,
                    borderColor: 'rgba(255, 255, 255, 0.12)',
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                },
            }
        });
    </script>
@endpush
