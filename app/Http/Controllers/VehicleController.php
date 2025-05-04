<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('status', 'available')
            ->with('model.brand.manufacturer')
            ->paginate(10);

        return VehicleResource::collection($vehicles);
    }
}
