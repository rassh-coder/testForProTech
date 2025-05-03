<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'model_id', 'vin', 'year', 'color',
        'mileage', 'status', 'location'
    ];

    protected $casts = [
        'location' => Point::class,
    ];

    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
