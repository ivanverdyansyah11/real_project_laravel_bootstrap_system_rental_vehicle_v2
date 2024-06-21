<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleSeriesStoreRequest;
use App\Http\Requests\VehicleSeriesUpdateRequest;
use App\Repositories\VehicleBrandRepositories;
use App\Repositories\VehicleSeriesRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleSeriesController extends Controller
{
    public function __construct(
        protected readonly VehicleSeriesRepositories $vehicleSeriesRepositories,
        protected readonly VehicleBrandRepositories $vehicleBrandRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.vehicle-series.index', [
            'title' => 'Vehicle Series Page',
            'page' => 'Dashboard',
            'vehicleSeries' => $this->vehicleSeriesRepositories->findAllWithPaginate($request->search),
            'vehicleBrand' => $this->vehicleBrandRepositories->findAll(),
            'search' => $request->search,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $series = $this->vehicleSeriesRepositories->findById($id);
            $brand = $this->vehicleBrandRepositories->findAll();
            return response()->json([
                'status_code' => 200,
                'series' => $series,
                'brand' => $brand,
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'status_code' => 404,
            ]);
        }
    }

    public function store(VehicleSeriesStoreRequest $request): RedirectResponse
    {
        try {
            $this->vehicleSeriesRepositories->store($request->validated());
            return redirect(route('vehicle-series.index'))->with('success', 'Successfully to add new vehicle series!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to add new vehicle series!');
        }
    }

    public function update(VehicleSeriesUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->vehicleSeriesRepositories->update($request->validated(), $id);
            return redirect(route('vehicle-series.index'))->with('success', 'Successfully to edit vehicle series!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit vehicle series!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->vehicleSeriesRepositories->delete($id);
            return redirect(route('vehicle-series.index'))->with('success', 'Successfully to delete vehicle series!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to delete vehicle series!');
        }
    }
}
