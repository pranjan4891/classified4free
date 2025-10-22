<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cities by country (just a sample - you can expand this)
        $citiesByCountry = [
            'India' => ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'],
            'Pakistan' => ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Peshawar'],
            'Bangladesh' => ['Dhaka', 'Chittagong', 'Khulna', 'Rajshahi', 'Sylhet', 'Rangpur'],
            'United States' => ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego'],
            'United Kingdom' => ['London', 'Birmingham', 'Manchester', 'Leeds', 'Glasgow', 'Liverpool'],
            'Canada' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Edmonton', 'Ottawa'],
            'Australia' => ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Gold Coast'],
            // Add more countries and their cities as needed
        ];

        // Note: We'll create this as a simple array for now.
        // In a real application, you might want to create a cities table.

        // For now, we'll just store this in cache or config for quick access
        cache()->forever('cities_by_country', $citiesByCountry);
    }
}
