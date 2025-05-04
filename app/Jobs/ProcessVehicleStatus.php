<?php

namespace App\Jobs;

use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVehicleStatus implements ShouldQueue
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
    public function handle(): void
    {
        $updateData = ['status' => $this->status];

        if ($this->lat && $this->lng) {
            $updateData['location'] = \DB::raw(
                "ST_SetSRID(ST_MakePoint({$this->lng}, {$this->lat}), 4326)"
            );
        }

        $this->vehicle->update($updateData);

        event(new \App\Events\VehicleStatusUpdated(
            $this->vehicle,
            $this->status
        ));
    }
}
