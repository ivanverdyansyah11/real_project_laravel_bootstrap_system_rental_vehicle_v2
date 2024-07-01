<?php

namespace App\Exports;

use App\Models\ReturnTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReturnTransactionsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ReturnTransaction::query()
            ->join('transactions', 'return_transactions.transactions_id', '=', 'transactions.id')
            ->join('bookings', 'transactions.bookings_id', '=', 'bookings.id')
            ->join('customers', 'bookings.customers_id', '=', 'customers.id')
            ->join('drivers', 'bookings.drivers_id', '=', 'drivers.id')
            ->join('vehicles', 'bookings.vehicles_id', '=', 'vehicles.id')
            ->select(
                'customers.fullname as customer_name',
                'drivers.fullname as driver_name',
                'vehicles.name as vehicle_name',
                'bookings.pickup_date',
                'bookings.return_date',
                'bookings.send_address',
                'transactions.total_price',
                'transactions.total_paid',
                'transactions.total_change',
                'transactions.payment_method',
                'return_transactions.return_kilometer',
                'return_transactions.description'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            "Customer Name",
            "Driver Name",
            "Vehicle Name",
            "Pickup Date",
            "Return Date",
            "Send Address",
            "Total Price",
            "Total Paid",
            "Total Change",
            "Payment Method",
            "Return Kilometer",
            "Description"
        ];
    }
}
