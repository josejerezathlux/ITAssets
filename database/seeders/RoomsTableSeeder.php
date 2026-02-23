<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => 'Office A', 'location' => 'Building 1, Floor 2', 'code' => 'B1-2A'],
            ['name' => 'Office B', 'location' => 'Building 1, Floor 2', 'code' => 'B1-2B'],
            ['name' => 'Office C', 'location' => 'Building 1, Floor 2', 'code' => 'B1-2C'],
            ['name' => 'Conference Room Alpha', 'location' => 'Building 1, Floor 2', 'code' => 'B1-2CF'],
            ['name' => 'Server Room', 'location' => 'Building 1, Basement', 'code' => 'B1-SR'],
            ['name' => 'IT Storage', 'location' => 'Building 1, Basement', 'code' => 'B1-ST'],
            ['name' => 'Reception', 'location' => 'Building 1, Floor 1', 'code' => 'B1-1R'],
            ['name' => 'HR Suite', 'location' => 'Building 1, Floor 3', 'code' => 'B1-3HR'],
            ['name' => 'Meeting Room 1', 'location' => 'Building 2', 'code' => 'B2-M1'],
            ['name' => 'Meeting Room 2', 'location' => 'Building 2', 'code' => 'B2-M2'],
        ];
        foreach ($rooms as $r) {
            Room::firstOrCreate(['name' => $r['name']], $r);
        }
    }
}
