<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Manufacturer;
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Производители с брендами и моделями
        Manufacturer::factory()
            ->count(5)
            ->has(
                Brand::factory()
                    ->count(3)
                    ->has(
                        VehicleModel::factory()
                            ->count(2)
                            ->hasVehicles(5)
                    )
            )
            ->create();

        // 2. Пользователи с арендами и транзакциями
        User::factory()
            ->count(20)
            ->has(
                Rental::factory()
                    ->count(3)
                    ->for(Vehicle::all()->random())
                    ->has(
                        Transaction::factory()
                            ->count(5)
                    )
            )
            ->create();

        // 3. Отдельные доступные автомобили
        Vehicle::factory()
            ->count(10)
            ->available()
            ->create();
    }
}
