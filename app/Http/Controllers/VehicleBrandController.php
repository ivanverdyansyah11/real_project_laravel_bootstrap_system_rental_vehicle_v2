<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleBrandStoreRequest;
use App\Http\Requests\VehicleBrandUpdateRequest;
use App\Repositories\VehicleBrandRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleBrandController extends Controller
{
    public function __construct(
        protected readonly VehicleBrandRepositories $vehicleBrandRepositories,
    ) {
    }

    public function index(Request $request): View
    {
        return view('dashboard.vehicle-brand.index', [
            'title' => 'Vehicle Brand Page',
            'page' => 'Dashboard',
            'vehicleBrands' => $this->vehicleBrandRepositories->findAllWithPaginate($request->search),
            'search' => $request->search,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $brand = $this->vehicleBrandRepositories->findById($id);
            return response()->json([
                'status_code' => 200,
                'brand' => $brand,
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'status_code' => 404,
            ]);
        }
    }

    public function store(VehicleBrandStoreRequest $request): RedirectResponse
    {
        try {
            $this->vehicleBrandRepositories->store($request->validated());
            return redirect(route('vehicle-brand.index'))->with('success', 'Successfully to add new vehicle brand!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to add new vehicle brand!');
        }
    }

    public function update(VehicleBrandUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->vehicleBrandRepositories->update($request->validated(), $id);
            return redirect(route('vehicle-brand.index'))->with('success', 'Successfully to edit vehicle brand!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Failed to edit vehicle brand!');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->vehicleBrandRepositories->delete($id);
            return redirect(route('vehicle-brand.index'))->with('success', 'Successfully to delete vehicle brand!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('vehicle-brand.index'))->with('failed', 'Failed to delete vehicle brand!');
        }
    }
}
