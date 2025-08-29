<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        // Available images to alternate between
        $images = [
            '/assets/images/1-DloPm3Vx.png',
            '/assets/images/3-BClu8jbQ.png',
            '/assets/images/4-BkO3CAjp.png',
            '/assets/images/7-CxEhnEfj.png',
            '/assets/images/10-kfJyDaBt.png'
        ];

        $products = [
            // Smartphones
            [
                'category_id' => $categories->where('slug', 'smartphones')->first()->id,
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'Latest iPhone with A17 Pro chip, 48MP camera, and titanium design',
                'price' => 189999.00,
                'old_price' => 199999.00,
                'image' => $images[0],
                'images' => [
                    $images[1],
                    $images[2],
                    $images[3],
                    $images[4]
                ],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 128,
                'stock_quantity' => 25,
                'is_featured' => true,
                'specifications' => [
                    'screen' => '6.1 inch Super Retina XDR',
                    'storage' => '128GB',
                    'color' => 'Natural Titanium',
                    'camera' => '48MP Main Camera'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'smartphones')->first()->id,
                'name' => 'Samsung Galaxy S24 Ultra',
                'slug' => 'samsung-galaxy-s24-ultra',
                'description' => 'Premium Android flagship with S Pen and AI features',
                'price' => 175000.00,
                'old_price' => 185000.00,
                'image' => $images[1],
                'images' => [
                    $images[2],
                    $images[3],
                    $images[4],
                    $images[0]
                ],
                'badge' => 'NEW',
                'rating' => 5,
                'reviews_count' => 95,
                'stock_quantity' => 20,
                'is_featured' => true,
                'specifications' => [
                    'screen' => '6.8 inch Dynamic AMOLED',
                    'storage' => '256GB',
                    'color' => 'Titanium Gray',
                    'camera' => '200MP Main Camera'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'smartphones')->first()->id,
                'name' => 'Tecno Camon 20 Pro',
                'slug' => 'tecno-camon-20-pro',
                'description' => 'Affordable smartphone with great camera performance',
                'price' => 45000.00,
                'image' => $images[2],
                'rating' => 4,
                'reviews_count' => 67,
                'stock_quantity' => 50,
                'specifications' => [
                    'screen' => '6.67 inch AMOLED',
                    'storage' => '256GB',
                    'color' => 'Dark Matter',
                    'camera' => '108MP Main Camera'
                ]
            ],

            // Laptops & Computers
            [
                'category_id' => $categories->where('slug', 'laptops-computers')->first()->id,
                'name' => 'MacBook Pro 14" M3',
                'slug' => 'macbook-pro-14-m3',
                'description' => 'Professional laptop with M3 chip for creators and developers',
                'price' => 450000.00,
                'old_price' => 480000.00,
                'image' => $images[3],
                'images' => [
                    $images[4],
                    $images[0],
                    $images[1],
                    $images[2],
                    $images[3]
                ],
                'badge' => 'HOT',
                'rating' => 5,
                'reviews_count' => 234,
                'stock_quantity' => 15,
                'is_featured' => true,
                'specifications' => [
                    'processor' => 'Apple M3 Chip',
                    'memory' => '16GB Unified Memory',
                    'storage' => '512GB SSD',
                    'display' => '14-inch Liquid Retina XDR'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'laptops-computers')->first()->id,
                'name' => 'Dell XPS 13 Plus',
                'slug' => 'dell-xps-13-plus',
                'description' => 'Premium Windows laptop with stunning design',
                'price' => 320000.00,
                'image' => $images[4],
                'rating' => 4,
                'reviews_count' => 156,
                'stock_quantity' => 12,
                'specifications' => [
                    'processor' => 'Intel Core i7-1360P',
                    'memory' => '16GB LPDDR5',
                    'storage' => '512GB SSD',
                    'display' => '13.4-inch OLED'
                ]
            ],

            // TVs & Home Entertainment
            [
                'category_id' => $categories->where('slug', 'tvs-home-entertainment')->first()->id,
                'name' => 'Samsung 65" QLED 4K TV',
                'slug' => 'samsung-65-qled-4k-tv',
                'description' => 'Premium QLED TV with Quantum HDR and Smart TV features',
                'price' => 280000.00,
                'old_price' => 320000.00,
                'image' => $images[0],
                'images' => [
                    $images[1],
                    $images[2],
                    $images[3]
                ],
                'badge' => '-12%',
                'rating' => 5,
                'reviews_count' => 189,
                'stock_quantity' => 8,
                'is_featured' => true,
                'specifications' => [
                    'screen_size' => '65 inches',
                    'resolution' => '4K Ultra HD',
                    'hdr' => 'Quantum HDR',
                    'smart_tv' => 'Tizen OS'
                ]
            ],

            // Audio & Headphones
            [
                'category_id' => $categories->where('slug', 'audio-headphones')->first()->id,
                'name' => 'Sony WH-1000XM5',
                'slug' => 'sony-wh-1000xm5',
                'description' => 'Industry-leading noise canceling headphones',
                'price' => 85000.00,
                'old_price' => 95000.00,
                'image' => $images[1],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 342,
                'stock_quantity' => 30,
                'is_featured' => true,
                'specifications' => [
                    'type' => 'Over-ear',
                    'noise_canceling' => 'Industry-leading',
                    'battery' => '30 hours',
                    'connectivity' => 'Bluetooth 5.2'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'audio-headphones')->first()->id,
                'name' => 'JBL Flip 6 Bluetooth Speaker',
                'slug' => 'jbl-flip-6-bluetooth-speaker',
                'description' => 'Portable waterproof speaker with powerful sound',
                'price' => 15000.00,
                'image' => $images[2],
                'rating' => 4,
                'reviews_count' => 98,
                'stock_quantity' => 45,
                'specifications' => [
                    'type' => 'Portable Bluetooth',
                    'waterproof' => 'IPX7',
                    'battery' => '12 hours',
                    'connectivity' => 'Bluetooth 5.1'
                ]
            ],

            // Cameras & Photography
            [
                'category_id' => $categories->where('slug', 'cameras-photography')->first()->id,
                'name' => 'Canon EOS R6 Mark II',
                'slug' => 'canon-eos-r6-mark-ii',
                'description' => 'Full-frame mirrorless camera for professional photography',
                'price' => 420000.00,
                'old_price' => 450000.00,
                'image' => $images[3],
                'badge' => 'HOT',
                'rating' => 5,
                'reviews_count' => 156,
                'stock_quantity' => 10,
                'is_featured' => true,
                'specifications' => [
                    'sensor' => '24.2MP Full-frame CMOS',
                    'video' => '4K 60p',
                    'autofocus' => 'Dual Pixel CMOS AF II',
                    'connectivity' => 'Wi-Fi & Bluetooth'
                ]
            ],

            // Gaming
            [
                'category_id' => $categories->where('slug', 'gaming')->first()->id,
                'name' => 'PlayStation 5 Console',
                'slug' => 'playstation-5-console',
                'description' => 'Next-gen gaming console with DualSense controller',
                'price' => 85000.00,
                'old_price' => 95000.00,
                'image' => $images[4],
                'images' => [
                    $images[0],
                    $images[1],
                    $images[2]
                ],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 423,
                'stock_quantity' => 15,
                'is_featured' => true,
                'specifications' => [
                    'storage' => '825GB SSD',
                    'resolution' => '4K Gaming',
                    'ray_tracing' => 'Hardware-accelerated',
                    'controller' => 'DualSense included'
                ]
            ],

            // Smart Home
            [
                'category_id' => $categories->where('slug', 'smart-home')->first()->id,
                'name' => 'Google Nest Hub Max',
                'slug' => 'google-nest-hub-max',
                'description' => 'Smart display with Google Assistant and camera',
                'price' => 35000.00,
                'image' => $images[0],
                'rating' => 4,
                'reviews_count' => 89,
                'stock_quantity' => 25,
                'specifications' => [
                    'screen' => '10-inch HD display',
                    'speaker' => 'Stereo speakers',
                    'camera' => '6.5MP camera',
                    'assistant' => 'Google Assistant'
                ]
            ],

            // Wearables
            [
                'category_id' => $categories->where('slug', 'wearables')->first()->id,
                'name' => 'Apple Watch Series 9',
                'slug' => 'apple-watch-series-9',
                'description' => 'Latest Apple Watch with health monitoring features',
                'price' => 75000.00,
                'old_price' => 85000.00,
                'image' => $images[1],
                'badge' => 'NEW',
                'rating' => 5,
                'reviews_count' => 234,
                'stock_quantity' => 20,
                'is_featured' => true,
                'specifications' => [
                    'screen' => 'Always-On Retina display',
                    'gps' => 'Built-in GPS',
                    'water_resistant' => '50m',
                    'battery' => '18 hours'
                ]
            ],

            // Tablets
            [
                'category_id' => $categories->where('slug', 'tablets')->first()->id,
                'name' => 'iPad Air 5th Generation',
                'slug' => 'ipad-air-5th-generation',
                'description' => 'Powerful tablet with M1 chip and Apple Pencil support',
                'price' => 120000.00,
                'old_price' => 135000.00,
                'image' => $images[2],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 187,
                'stock_quantity' => 18,
                'is_featured' => true,
                'specifications' => [
                    'screen' => '10.9-inch Liquid Retina',
                    'processor' => 'Apple M1 chip',
                    'storage' => '256GB',
                    'pencil' => 'Apple Pencil compatible'
                ]
            ],

            // Accessories
            [
                'category_id' => $categories->where('slug', 'accessories')->first()->id,
                'name' => 'Anker PowerCore 20000mAh',
                'slug' => 'anker-powercore-20000mah',
                'description' => 'High-capacity portable charger for all devices',
                'price' => 8500.00,
                'image' => $images[3],
                'rating' => 4,
                'reviews_count' => 156,
                'stock_quantity' => 60,
                'specifications' => [
                    'capacity' => '20000mAh',
                    'output' => '18W USB-C',
                    'ports' => '2 USB-A, 1 USB-C',
                    'compatibility' => 'All devices'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
