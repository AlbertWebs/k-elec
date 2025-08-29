<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Smartphones',
                'slug' => 'smartphones',
                'icon' => 'fas fa-mobile-alt',
                'description' => 'Latest smartphones and mobile devices',
                'sort_order' => 1
            ],
            [
                'name' => 'Laptops & Computers',
                'slug' => 'laptops-computers',
                'icon' => 'fas fa-laptop',
                'description' => 'Laptops, desktops, and computer accessories',
                'sort_order' => 2
            ],
            [
                'name' => 'TVs & Home Entertainment',
                'slug' => 'tvs-home-entertainment',
                'icon' => 'fas fa-tv',
                'description' => 'Smart TVs, sound systems, and home entertainment',
                'sort_order' => 3
            ],
            [
                'name' => 'Audio & Headphones',
                'slug' => 'audio-headphones',
                'icon' => 'fas fa-headphones',
                'description' => 'Headphones, speakers, and audio equipment',
                'sort_order' => 4
            ],
            [
                'name' => 'Cameras & Photography',
                'slug' => 'cameras-photography',
                'icon' => 'fas fa-camera',
                'description' => 'Digital cameras, lenses, and photography gear',
                'sort_order' => 5
            ],
            [
                'name' => 'Gaming',
                'slug' => 'gaming',
                'icon' => 'fas fa-gamepad',
                'description' => 'Gaming consoles, accessories, and games',
                'sort_order' => 6
            ],
            [
                'name' => 'Smart Home',
                'slug' => 'smart-home',
                'icon' => 'fas fa-home',
                'description' => 'Smart home devices and automation',
                'sort_order' => 7
            ],
            [
                'name' => 'Wearables',
                'slug' => 'wearables',
                'icon' => 'fas fa-clock',
                'description' => 'Smartwatches, fitness trackers, and wearables',
                'sort_order' => 8
            ],
            [
                'name' => 'Tablets',
                'slug' => 'tablets',
                'icon' => 'fas fa-tablet-alt',
                'description' => 'Tablets and mobile computing devices',
                'sort_order' => 9
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'icon' => 'fas fa-plug',
                'description' => 'Cables, chargers, and electronic accessories',
                'sort_order' => 10
            ],
            [
                'name' => 'Office Electronics',
                'slug' => 'office-electronics',
                'icon' => 'fas fa-print',
                'description' => 'Printers, scanners, and office electronics',
                'sort_order' => 11
            ],
            [
                'name' => 'Security & Surveillance',
                'slug' => 'security-surveillance',
                'icon' => 'fas fa-shield-alt',
                'description' => 'Security cameras and surveillance systems',
                'sort_order' => 12
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
