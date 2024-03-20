<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use HasFactory;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::runProductSeeder();
    }

    /**
     * @return Product[]
     */
    public static function runProductSeeder(): array
    {
        $data = [];
        $data['FR1'] = Product::factory()->create([
            'code' => 'FR1',
            'name' => 'Fruit tea',
            'price' => 3.11,
        ]);

        $data['SR1'] = Product::factory()->create([
            'code' => 'SR1',
            'name' => 'Strawberries',
            'price' => 5.00,
        ]);

        $data['CF1'] = Product::factory()->create([
            'code' => 'CF1',
            'name' => 'Coffee',
            'price' => 11.23,
        ]);

        return $data;
    }

}
