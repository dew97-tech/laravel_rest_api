<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::create(['name' => 'Color']);
        Attribute::create(['name' => 'Size']);
        Attribute::create(['name' => 'Weight']);
        Attribute::create(['name' => 'Material']);
        Attribute::create(['name' => 'Brand']);
        Attribute::create(['name' => 'Model']);
        Attribute::create(['name' => 'Capacity']);
        Attribute::create(['name' => 'Dimensions']);
        Attribute::create(['name' => 'Warranty']);
        Attribute::create(['name' => 'Power']);
    }
}
