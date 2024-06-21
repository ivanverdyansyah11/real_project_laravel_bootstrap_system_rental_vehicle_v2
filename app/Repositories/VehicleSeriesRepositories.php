<?php

namespace App\Repositories;

use App\Models\VehicleSeries;

class VehicleSeriesRepositories
{
    public function __construct(
        protected readonly VehicleSeries $series,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->series->where('serial_number', 'like', "%$request%")->paginate(6);
        } else {
            return $this->series->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->series->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->series->with('vehicle_brand')->where('id', $id)->first();
    }

    public function store($request)
    {
        return $this->series->create($request);
    }

    public function update($request, $id)
    {
        $series = $this->findById($id);
        return $series->update($request);
    }

    public function delete($id)
    {
        $series = $this->findById($id);
        return $series->delete();
    }
}
