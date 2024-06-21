<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use App\Repositories\VehicleRepositories;
use App\Repositories\VehicleSeriesRepositories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function __construct(
        protected readonly VehicleRepositories $vehicleRepositories,
        protected readonly VehicleSeriesRepositories $vehicleSeriesRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.vehicle.index', [
            'title' => 'Vehicle Page',
            'page' => 'Dashboard',
            'vehicles' => $this->vehicleRepositories->findAllWithPaginate($request->search),
            'search' => $request->search,
        ]);
    }

    public function show(int $id): View
    {
        return view('dashboard.vehicle.detail', [
            'title' => 'Detail Vehicle Page',
            'page' => 'Dashboard',
            'vehicle' => $this->vehicleRepositories->findById($id),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.vehicle.create', [
            'title' => 'Create Vehicle Page',
            'page' => 'Dashboard',
            'vehicleSeries' => $this->vehicleSeriesRepositories->findAll(),
        ]);
    }

    public function store(VehicleStoreRequest $request): RedirectResponse
    {
        try {
            $this->vehicleRepositories->store($request->validated());
            return redirect(route('vehicle.index'))->with('success', 'Successfully to add new vehicle!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('vehicle.create'))->with('failed', 'Failed to add new vehicle!');
        }
    }

    public function edit(int $id): View
    {
        return view('dashboard.vehicle.edit', [
            'title' => 'Edit Vehicle Page',
            'page' => 'Dashboard',
            'vehicle' => $this->vehicleRepositories->findById($id),
            'vehicleSeries' => $this->vehicleSeriesRepositories->findAll(),
        ]);
    }

    public function update(VehicleUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->vehicleRepositories->update($request->validated(), $id);
            return redirect(route('vehicle.index'))->with('success', 'Successfully to edit vehicle!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit vehicle!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->vehicleRepositories->delete($id);
            return redirect(route('vehicle.index'))->with('success', 'Successfully to delete vehicle!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('vehicle.index'))->with('failed', 'Failed to delete vehicle!');
        }
    }
}
