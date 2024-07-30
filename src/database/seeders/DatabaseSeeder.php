<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            "name" => "Test User",
            "username" => "test",
            "email" => "test@example.com",
            "password" => "password",
            "status" => "active",
        ]);
        User::factory()->create([
            "name" => "Test User inactive",
            "username" => "test inactive",
            "email" => "testinactive@example.com",
            "password" => "password"
        ]);
        $countries = [
            'Serbia',
            'Hungary',
            'United States',
            'Canada',
            'United Kingdom',
            'Germany',
            'France',
            'Japan',
            'Australia',
            'Brazil',
            'China',
            'India'
        ];

        foreach ($countries as $countryName) {
            Country::create([
                'name' => $countryName
            ]);
        }
    }
}
