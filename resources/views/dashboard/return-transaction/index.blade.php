@extends('template.main')

@section('content-dashboard')
    <div class="content container mt-4">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success w-100 mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card-default">
                    <div class="wrapper d-flex align-items-center justify-content-between gap-2">
                        <form class="form w-100 d-flex gap-2" method="GET">
                            <input type="date" class="input w-100" id="pickup_date" placeholder="Search pickup date.."
                                autocomplete="off" name="pickup_date"
                                value="{{ $search->pickup_date != null ? $search->pickup_date : '' }}">
                            <input type="date" class="input w-100" id="search" placeholder="Search return date.."
                                autocomplete="off" name="return_date"
                                value="{{ $search->return_date != null ? $search->return_date : '' }}">
                            <button type="submit" class="button-primary-small" style="width: 46px; height: 46px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    <div class="wrapper-table mt-4">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Phone Number</th>
                                    <th>Car Name</th>
                                    <th>Send Address</th>
                                    <th>Pickup Date</th>
                                    <th>Return Date</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($return_transactions->count() == 0)
                                    <td colspan="7">Data transaction not found!</td>
                                @else
                                    @foreach ($return_transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->booking->customer->fullname }}</td>
                                            <td>{{ $transaction->booking->customer->phone_number }}</td>
                                            <td>{{ $transaction->booking->vehicle->name }}</td>
                                            <td>{{ $transaction->booking->send_address }}</td>
                                            <td>{{ $transaction->booking->pickup_date }}</td>
                                            <td>{{ $transaction->booking->return_date }}</td>
                                            <td class="d-flex justify-content-end gap-1 table-mobile" style="width: 200px;">
                                                <a href="{{ route('return-transaction.edit', $transaction->id) }}"
                                                    class="wrapper-icon icon-edit d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-circle-check" style="font-size: 0.85rem;"></i>
                                                </a>
                                                <a href="{{ route('return-transaction.show', $transaction->id) }}"
                                                    class="wrapper-icon icon-detail d-flex align-items-center justify-content-center">
                                                    <i class="fa-solid fa-eye" style="font-size: 0.85rem;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="wrapper-paginate">
                        {{ $return_transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
