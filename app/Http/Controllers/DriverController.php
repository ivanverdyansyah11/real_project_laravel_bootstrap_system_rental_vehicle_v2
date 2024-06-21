<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverStoreRequest;
use App\Http\Requests\DriverUpdateRequest;
use App\Repositories\DriverRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function __construct(
        protected readonly DriverRepositories $driverRepositories,
        protected readonly UserRepositories $userRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.driver.index', [
            'title' => 'Driver Page',
            'page' => 'Dashboard',
            'drivers' => $this->driverRepositories->findAllWithPaginate($request->search),
            'search' => $request->search,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.driver.detail', [
            'title' => 'Detail Driver Page',
            'page' => 'Dashboard',
            'user' => $this->userRepositories->findByDriverId($id),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.driver.create', [
            'title' => 'Create Driver Page',
            'page' => 'Dashboard',
        ]);
    }

    public function store(DriverStoreRequest $request): RedirectResponse
    {
        try {
            $driver = $this->driverRepositories->store($request->except('name', 'email', 'password'));
            $request['drivers_id'] = $driver->id;
            $this->userRepositories->store($request->only('name', 'email', 'password', 'drivers_id'));
            return redirect(route('driver.index'))->with('success', 'Successfully to add new driver!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('driver.create'))->with('failed', 'Failed to add new driver!');
        }
    }

    public function edit(int $id): View
    {
        return view('dashboard.driver.edit', [
            'title' => 'Edit Driver Page',
            'page' => 'Dashboard',
            'user' => $this->userRepositories->findByDriverId($id),
        ]);
    }

    public function update(DriverUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->driverRepositories->update($request->except('name', 'email', 'password'), $id);
            $this->userRepositories->updateDriver($request->only('name', 'email'), $id);
            return redirect(route('driver.index'))->with('success', 'Successfully to edit driver!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit driver!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->driverRepositories->delete($id);
            $this->userRepositories->deleteDriver($id);
            return redirect(route('driver.index'))->with('success', 'Successfully to delete driver!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('driver.index'))->with('failed', 'Failed to delete driver!');
        }
    }
}
