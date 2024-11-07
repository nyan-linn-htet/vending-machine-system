<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Coke',
                'price' => '3.99',
                'quantity' => '10',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Pepsi',
                'price' => '6.885',
                'quantity' => '10',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Water',
                'price' => '0.5',
                'quantity' => '10',
                'created_at' => now(),
            ],
        ];

        Product::insert($products);
    }
}
