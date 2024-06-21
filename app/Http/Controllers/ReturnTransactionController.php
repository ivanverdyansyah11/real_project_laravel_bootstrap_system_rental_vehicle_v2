<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnTransactionStoreRequest;
use App\Repositories\ReturnTransactionRepositories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReturnTransactionController extends Controller
{
    public function __construct(
        protected readonly ReturnTransactionRepositories $returnTransactionRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.return-transaction.index', [
            'title' => 'Return Transaction Page',
            'page' => 'Dashboard',
            'return_transactions' => $this->returnTransactionRepositories->findAllWithPaginate($request),
            'search' => $request,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.return-transaction.detail', [
            'title' => 'Detail Transaction Page',
            'page' => 'Dashboard',
            'transaction' => $this->returnTransactionRepositories->findById($id),
        ]);
    }

    public function edit(int $id): View
    {
        return view('dashboard.return-transaction.create', [
            'title' => 'Create Transaction Page',
            'page' => 'Dashboard',
            'transaction' => $this->returnTransactionRepositories->findById($id),
        ]);
    }

    public function store(ReturnTransactionStoreRequest $request): RedirectResponse
    {
        try {
            $this->returnTransactionRepositories->store($request->validated());
            return redirect(route('return-transaction.index'))->with('success', 'Successfully to return transaction!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to return transaction!');
        }
    }
}
