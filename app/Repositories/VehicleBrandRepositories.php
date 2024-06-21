<?php

namespace App\Repositories;

use App\Models\VehicleBrand;

class VehicleBrandRepositories
{
    public function __construct(
        protected readonly VehicleBrand $brand,
    ) {
    }

    public function findAllWithPaginate($request)
    {
        if ($request != null) {
            return $this->brand->where('name', 'like', "%$request%")->paginate(6);
        } else {
            return $this->brand->latest()->paginate(6);
        }
    }

    public function findAll()
    {
        return $this->brand->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->brand->where('id', $id)->first();
    }

    public function store($request)
    {
        return $this->brand->create($request);
    }

    public function update($request, $id)
    {
        $brand = $this->findById($id);
        return $brand->update($request);
    }

    public function delete($id)
    {
        $brand = $this->findById($id);
        return $brand->delete();
    }
}
