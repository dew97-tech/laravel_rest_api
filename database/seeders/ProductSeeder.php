<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Samsung Galaxy S21',
                'category' => 'Electronics',
                'attributes' => [
                    'Brand' => 'Samsung',
                    'Model' => 'Galaxy S21',
                    'Color' => 'Phantom Gray',
                    'Warranty' => '1 year',
                ],
            ],
            [
                'name' => 'Levi\'s 501 Original Jeans',
                'category' => 'Clothing',
                'attributes' => [
                    'Brand' => 'Levi\'s',
                    'Size' => '32',
                    'Color' => 'Blue',
                    'Material' => 'Denim',
                ],
            ],
            [
                'name' => 'Whirlpool Refrigerator',
                'category' => 'Home Appliances',
                'attributes' => [
                    'Brand' => 'Whirlpool',
                    'Model' => 'WRX735SDHZ',
                    'Capacity' => '24.7 cu. ft.',
                    'Dimensions' => '70.13 x 36 x 35.25 inches',
                    'Power' => '115V',
                ],
            ],
            [
                'name' => 'The Great Gatsby',
                'category' => 'Books',
                'attributes' => [
                    'Author' => 'F. Scott Fitzgerald',
                    'Publisher' => 'Scribner',
                    'ISBN' => '978-0743273565',
                    'Pages' => '180',
                ],
            ],
            [
                'name' => 'Ikea Dining Table',
                'category' => 'Furniture',
                'attributes' => [
                    'Brand' => 'Ikea',
                    'Model' => 'LISABO',
                    'Material' => 'Ash veneer',
                    'Dimensions' => '55 1/8 x 31 1/2 inches',
                ],
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::where('name', $productData['category'])->first();
            $product = Product::create([
                'name' => $productData['name'],
                'category_id' => $category->id,
            ]);

            foreach ($productData['attributes'] as $attributeName => $value) {
                $attribute = Attribute::where('name', $attributeName)->first();
                if ($attribute) {
                    $product->attributes()->attach($attribute->id, ['value' => $value]);
                }
            }
        }
    }
}
