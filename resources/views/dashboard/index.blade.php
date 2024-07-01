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
    </div>
@endsection
