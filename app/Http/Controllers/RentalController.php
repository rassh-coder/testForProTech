<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/rentals/start",
     *     summary="Start new rental",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"vehicle_id"},
     *             @OA\Property(property="vehicle_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Rental started"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function start(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        if ($vehicle->status !== 'available') {
            return response()->json(['message' => 'Vehicle not available'], 409);
        }

        $rental = Rental::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'started_at' => now(),
            'status' => 'active'
        ]);

        $vehicle->update(['status' => 'in_use']);
        ProcessVehicleStatus::dispatch($vehicle, 'in_use');

        return response()->json($rental, 201);
    }
}
