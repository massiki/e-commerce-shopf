<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'Premium noise-cancelling wireless headphones with 40-hour battery life. Features advanced Bluetooth 5.3 technology, comfortable over-ear design with memory foam cushions, and crystal-clear audio quality.',
                'price' => 199000,
                'stock' => 50,
                'image' => null,
                'category' => 'Electronics',
            ],
            [
                'name' => 'Minimalist Leather Watch',
                'description' => 'Elegant minimalist watch with genuine Italian leather strap. Features a Japanese quartz movement, sapphire crystal glass, and water resistance up to 50 meters. Perfect for everyday wear.',
                'price' => 149000,
                'stock' => 30,
                'image' => null,
                'category' => 'Accessories',
            ],
            [
                'name' => 'Organic Cotton T-Shirt',
                'description' => 'Sustainably made organic cotton t-shirt with a relaxed fit. Available in multiple colors. Pre-shrunk fabric, reinforced seams, and tagless comfort label.',
                'price' => 34000,
                'stock' => 100,
                'image' => null,
                'category' => 'Clothing',
            ],
            [
                'name' => 'Smart Home Speaker',
                'description' => 'AI-powered smart speaker with premium 360-degree sound. Control your smart home devices, play music, get weather updates, and more with voice commands.',
                'price' => 129000,
                'stock' => 45,
                'image' => null,
                'category' => 'Electronics',
            ],
            [
                'name' => 'Running Sneakers Pro',
                'description' => 'High-performance running shoes with responsive cushioning and breathable mesh upper. Lightweight design with excellent arch support and durable rubber outsole.',
                'price' => 89000,
                'stock' => 75,
                'image' => null,
                'category' => 'Footwear',
            ],
            [
                'name' => 'Stainless Steel Water Bottle',
                'description' => 'Double-wall vacuum insulated water bottle that keeps drinks cold for 24 hours or hot for 12 hours. BPA-free, leak-proof lid, and eco-friendly design. 750ml capacity.',
                'price' => 29000,
                'stock' => 120,
                'image' => null,
                'category' => 'Lifestyle',
            ],
            [
                'name' => 'Mechanical Keyboard RGB',
                'description' => 'Premium mechanical keyboard with customizable RGB backlighting, Cherry MX switches, and aircraft-grade aluminum frame. N-key rollover and detachable USB-C cable.',
                'price' => 159000,
                'stock' => 40,
                'image' => null,
                'category' => 'Electronics',
            ],
            [
                'name' => 'Canvas Backpack',
                'description' => 'Durable waxed canvas backpack with laptop compartment. Features padded shoulder straps, multiple organizer pockets, and water-resistant coating. 25L capacity.',
                'price' => 79000,
                'stock' => 60,
                'image' => null,
                'category' => 'Accessories',
            ],
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'Extra-thick 6mm eco-friendly yoga mat with anti-slip texture. Made from natural rubber with alignment guidelines. Includes carrying strap. 183cm x 68cm.',
                'price' => 49000,
                'stock' => 80,
                'image' => null,
                'category' => 'Lifestyle',
            ],
            [
                'name' => 'Denim Jacket Classic',
                'description' => 'Timeless classic denim jacket made from premium selvedge denim. Features button closure, chest pockets, and adjustable waist tabs. Medium wash with subtle fading.',
                'price' => 119000,
                'stock' => 35,
                'image' => null,
                'category' => 'Clothing',
            ],
            [
                'name' => 'Portable Power Bank',
                'description' => '20000mAh portable charger with USB-C PD fast charging. Charges phones up to 5 times. LED indicator display, slim design, and airline-approved for travel.',
                'price' => 44000,
                'stock' => 90,
                'image' => null,
                'category' => 'Electronics',
            ],
            [
                'name' => 'Ceramic Coffee Mug Set',
                'description' => 'Set of 4 handcrafted ceramic coffee mugs with modern geometric patterns. Microwave and dishwasher safe. 350ml capacity each. Perfect gift for coffee lovers.',
                'price' => 39000,
                'stock' => 55,
                'image' => null,
                'category' => 'Lifestyle',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
