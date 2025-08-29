<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;

class CarouselSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'New Collection',
                'description' => 'Latest electronics with cutting-edge technology and innovation',
                'image' => null, // Will be uploaded through admin panel
                'button_text' => 'Buy Now',
                'button_link' => '/products',
                'background_color' => 'blue',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Limited Time',
                'description' => 'Get the latest smartphones with amazing features and performance',
                'image' => null, // Will be uploaded through admin panel
                'button_text' => 'Shop Now',
                'button_link' => '/products',
                'background_color' => 'green',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Exclusive Deal',
                'description' => 'Experience immersive gaming and entertainment like never before',
                'image' => null, // Will be uploaded through admin panel
                'button_text' => 'Explore',
                'button_link' => '/products',
                'background_color' => 'purple',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            CarouselSlide::create($slide);
        }
    }
}
