<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Repositories\CustomerRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct(
        protected readonly CustomerRepositories $customerRepositories,
        protected readonly UserRepositories $userRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.customer.index', [
            'title' => 'Customer Page',
            'page' => 'Dashboard',
            'customers' => $this->customerRepositories->findAllWithPaginate($request->search),
            'search' => $request->search,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.customer.detail', [
            'title' => 'Detail Customer Page',
            'page' => 'Dashboard',
            'user' => $this->userRepositories->findByCustomerId($id),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.customer.create', [
            'title' => 'Create Customer Page',
            'page' => 'Dashboard',
        ]);
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        try {
            $customer = $this->customerRepositories->store($request->except('name', 'email', 'password'));
            $request['customers_id'] = $customer->id;
            $this->userRepositories->store($request->only('name', 'email', 'password', 'customers_id'));
            return redirect(route('customer.index'))->with('success', 'Successfully to add new customer!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('customer.create'))->with('failed', 'Failed to add new customer!');
        }
    }

    public function edit(int $id): View
    {
        return view('dashboard.customer.edit', [
            'title' => 'Edit Customer Page',
            'page' => 'Dashboard',
            'user' => $this->userRepositories->findByCustomerId($id),
        ]);
    }

    public function update(CustomerUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->customerRepositories->update($request->except('name', 'email', 'password'), $id);
            $this->userRepositories->updateCustomer($request->only('name', 'email'), $id);
            return redirect(route('customer.index'))->with('success', 'Successfully to edit customer!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit customer!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->customerRepositories->delete($id);
            $this->userRepositories->deleteCustomer($id);
            return redirect(route('customer.index'))->with('success', 'Successfully to delete customer!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('customer.index'))->with('failed', 'Failed to delete customer!');
        }
    }
}
