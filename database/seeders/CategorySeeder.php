<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Vehicles', 'icon' => 'adicon-car', 'slug' => 'vehicles'],
            ['name' => 'Industrial & Business', 'icon' => 'adicon-tv', 'slug' => 'industrial-business'],
            ['name' => 'Electronics & Appliances', 'icon' => 'adicon-tv', 'slug' => 'electronics-appliances'],
            ['name' => 'Furniture & Home Decor', 'icon' => 'adicon-sofa', 'slug' => 'furniture-home-decor'],
            ['name' => 'Jobs', 'icon' => 'adicon-briefcase', 'slug' => 'jobs'],
            ['name' => 'Real Estate', 'icon' => 'adicon-buildings', 'slug' => 'real-estate'],
            ['name' => 'Services', 'icon' => 'adicon-bell', 'slug' => 'services'],
            ['name' => 'Education & Learning', 'icon' => 'adicon-hat', 'slug' => 'education-learning'],
            ['name' => 'Animals & Pet Care', 'icon' => 'adicon-dog', 'slug' => 'animals-pet-care'],
            ['name' => 'Fashion & Lifestyle', 'icon' => 'adicon-heal', 'slug' => 'fashion-lifestyle'],
            ['name' => 'Kids & Baby Products', 'icon' => 'adicon-smile', 'slug' => 'kids-baby-products'],
            ['name' => 'Travel & Tourism', 'icon' => 'adicon-hearts', 'slug' => 'travel-tourism'],
        ];

        $subcategories = [
            'Vehicles' => [
                'Cars', 'Bikes', 'Scooters', 'Commercial Vehicles', 'Spare Parts & Accessories', 'Electric Vehicles', 'Boats', 'Others'
            ],
            'Industrial & Business' => [
                'Machinery & Equipment', 'Industrial Tools', 'Business for Sale', 'Franchise Opportunities', 'Office Supplies', 'Construction Material'
            ],
            'Electronics & Appliances' => [
                'Mobile Phones', 'Tablets', 'Laptops & Computers', 'TVs, Audio & Video', 'Cameras & Lenses', 'Gaming Consoles', 'Home Appliances (Fridge, AC, Washing Machine)', 'Smart Gadgets'
            ],
            'Furniture & Home Decor' => [
                'Sofas & Chairs', 'Beds & Wardrobes', 'Tables & Desks', 'Kitchen Furniture', 'Office Furniture', 'Home Decor Items'
            ],
            'Jobs' => [
                'Full-Time', 'Part-Time', 'Work From Home', 'Freelance', 'Internship', 'Government Jobs', 'Abroad Jobs', 'Others'
            ],
            'Real Estate' => [
                'Houses for Sale', 'Houses for Rent', 'Apartments / Flats', 'Commercial Property', 'Lands & Plots', 'PG & Roommates', 'Office Space', 'Vacation Rentals'
            ],
            'Services' => [
                'Home Services (Plumber, Electrician, Carpenter)', 'Repair Services (Mobile, Laptop, AC, etc.)', 'Packers & Movers', 'Beauty & Spa', 'Coaching & Tuition', 'Event Management', 'Travel & Transport', 'Legal & Financial', 'Cleaning Services'
            ],
            'Education & Learning' => [
                'Coaching Classes', 'Online Courses', 'Study Material & Books', 'Skill Development', 'School / College Admissions', 'Competitive Exams'
            ],
            'Animals & Pet Care' => [
                'Dogs', 'Cats', 'Birds', 'Fish & Aquariums', 'Pet Food & Accessories', 'Pet Adoption', 'Pet Grooming'
            ],
            'Fashion & Lifestyle' => [
                'Men\'s Clothing', 'Women\'s Clothing', 'Footwear', 'Watches', 'Jewellery', 'Bags & Accessories', 'Perfumes & Cosmetics'
            ],
            'Kids & Baby Products' => [
                'Baby Clothes', 'Toys', 'Baby Gear', 'School Supplies'
            ],
            'Travel & Tourism' => [
                'Holiday Packages', 'Hotels & Stays', 'Car Rentals', 'Ticket Booking', 'Adventure Tours'
            ],
        ];

        foreach ($categories as $category) {
            $cat = Category::create($category);

            if (isset($subcategories[$cat->name])) {
                foreach ($subcategories[$cat->name] as $sub) {
                    Subcategory::create([
                        'name' => $sub,
                        'slug' => Str::slug($sub) . '-' . $cat->id,
                        'category_id' => $cat->id,
                    ]);
                }
            }
        }
    }
}
