<?php

namespace App\Http\Controllers;

use App\Models\ReturnTransaction;
use App\Models\Transaction;
use App\Repositories\CustomerRepositories;
use App\Repositories\DriverRepositories;
use App\Repositories\ReturnTransactionRepositories;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(
        protected readonly Transaction $transaction,
        protected readonly CustomerRepositories $customerRepositories,
        protected readonly DriverRepositories $driverRepositories,
        protected readonly ReturnTransactionRepositories $returnTransactionRepositories,
    ) {
    }

    public function index()
    {
        if (auth()->user()->admin) {
            $total_income = $this->transaction->sum('total_price');
        } elseif (auth()->user()->driver) {
            $total_income = $this->transaction->whereHas('booking', function ($query) {
                $query->where('drivers_id', auth()->user()->driver->id);
            })->sum('total_price');
        } elseif (auth()->user()->customer) {
            $total_income = $this->transaction->whereHas('booking', function ($query) {
                $query->where('customers_id', auth()->user()->customer->id);
            })->sum('total_price');
        }

        $monthlyTransactions = array_fill(1, 12, 0);
        $transactions = ReturnTransaction::select(
            DB::raw('MONTH(bookings.pickup_date) as month'),
            DB::raw('COUNT(return_transactions.id) as total_transactions')
        )
            ->join('transactions', 'return_transactions.transactions_id', '=', 'transactions.id')
            ->join('bookings', 'transactions.bookings_id', '=', 'bookings.id')
            ->whereYear('bookings.pickup_date', '=', date('Y'))
            ->groupBy(DB::raw('MONTH(bookings.pickup_date)'))
            ->orderBy(DB::raw('MONTH(bookings.pickup_date)'))
            ->get();

        foreach ($transactions as $transaction) {
            $monthlyTransactions[$transaction->month] = $transaction->total_transactions;
        }

        return view('dashboard.index', [
            'title' => 'Dashboard Page',
            'page' => 'Dashboard',
            'total_customer' => count($this->customerRepositories->findAll()),
            'total_driver' => count($this->driverRepositories->findAll()),
            'total_transaction' => count($this->returnTransactionRepositories->findAll()),
            'total_income' => $total_income,
            'data_transaction' => $monthlyTransactions,
        ]);
    }
}
