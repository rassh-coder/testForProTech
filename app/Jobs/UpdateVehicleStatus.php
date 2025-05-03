<?php

namespace App\Jobs;

use App\Events\VehicleStatusUpdated;
use App\Models\Vehicle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateVehicleStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Vehicle $vehicle,
        public string $status,
        public ?float $lat = null,
        public ?float $lng = null
    ) {}

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->vehicle->update([
            'status' => $this->data['status'],
            'location' => DB::raw("ST_MakePoint({$this->data['lng']}, {$this->data['lat']})"),
        ]);

        event(new VehicleStatusUpdated($this->vehicle, $this->data['status']));
    }
}
