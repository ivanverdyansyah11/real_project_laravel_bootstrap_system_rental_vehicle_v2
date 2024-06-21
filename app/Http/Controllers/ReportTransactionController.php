<?php

namespace App\Http\Controllers;

use App\Repositories\ReturnTransactionRepositories;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportTransactionController extends Controller
{
    public function __construct(
        protected readonly ReturnTransactionRepositories $returnTransactionRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.report-transaction.index', [
            'title' => 'Report Transaction Page',
            'page' => 'Dashboard',
            'transactions' => $this->returnTransactionRepositories->findAllWithPaginate($request),
            'search' => $request,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.report-transaction.detail', [
            'title' => 'Detail Report Transaction Page',
            'page' => 'Dashboard',
            'transaction' => $this->returnTransactionRepositories->findById($id),
        ]);
    }
}
