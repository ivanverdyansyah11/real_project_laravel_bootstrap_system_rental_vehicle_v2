<?php

namespace App\Http\Controllers;

use App\Repositories\ReturnTransactionRepositories;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Exports\ReturnTransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportReturnTransactionController extends Controller
{
    public function __construct(
        protected readonly ReturnTransactionRepositories $returnTransactionRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.report-return-transaction.index', [
            'title' => 'Report Return Transaction Page',
            'page' => 'Dashboard',
            'returns' => $this->returnTransactionRepositories->findReturnAllWithPaginate($request),
            'search' => $request,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.report-return-transaction.detail', [
            'title' => 'Detail Report Return Transaction Page',
            'page' => 'Dashboard',
            'return' => $this->returnTransactionRepositories->findReturnById($id),
        ]);
    }

    public function export()
    {
        return Excel::download(new ReturnTransactionsExport, 'return-transaction.xlsx');
    }
}
