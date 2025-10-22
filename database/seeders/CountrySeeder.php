<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\City;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'USA', 'code' => 'US'],
            ['name' => 'United Kingdom', 'code' => 'UK'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Japan', 'code' => 'JP']
        ];

        foreach ($countries as $countryData) {
            $country = Country::create($countryData);

            // Add cities for each country
            $cities = $this->getCitiesForCountry($country->name);
            foreach ($cities as $cityName) {
                City::create([
                    'name' => $cityName,
                    'country_id' => $country->id
                ]);
            }
        }
    }

    private function getCitiesForCountry($country)
    {
        $cities = [
            'India' => ['Delhi', 'Mumbai', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'],
            'Pakistan' => ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Peshawar'],
            'Bangladesh' => ['Dhaka', 'Chittagong', 'Khulna', 'Rajshahi', 'Sylhet', 'Rangpur'],
            'USA' => ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego'],
            'United Kingdom' => ['London', 'Birmingham', 'Manchester', 'Leeds', 'Glasgow', 'Liverpool'],
            'Canada' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Edmonton', 'Ottawa'],
            'Australia' => ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Gold Coast'],
            'France' => ['Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice', 'Nantes'],
            'Germany' => ['Berlin', 'Hamburg', 'Munich', 'Cologne', 'Frankfurt', 'Stuttgart'],
            'Japan' => ['Tokyo', 'Yokohama', 'Osaka', 'Nagoya', 'Sapporo', 'Fukuoka']
        ];

        return $cities[$country] ?? [];
    }
}
