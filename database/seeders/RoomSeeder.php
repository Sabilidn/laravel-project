<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'name' => 'Deluxe Suite',
            'description' => 'Spacious suite with ocean view and premium amenities',
            'price_per_night' => 250.00,
            'capacity' => 2,
            'available' => true,
        ]);

        Room::create([
            'name' => 'Standard Room',
            'description' => 'Comfortable room with basic amenities',
            'price_per_night' => 120.00,
            'capacity' => 2,
            'available' => true,
        ]);

        Room::create([
            'name' => 'Family Room',
            'description' => 'Large room perfect for families with children',
            'price_per_night' => 180.00,
            'capacity' => 4,
            'available' => true,
        ]);

        Room::create([
            'name' => 'Executive Suite',
            'description' => 'Luxury suite with workspace and premium services',
            'price_per_night' => 350.00,
            'capacity' => 2,
            'available' => true,
        ]);
    }
}
