<?php

namespace Database\Seeders;

use App\Models\AssetCategory;
use Illuminate\Database\Seeder;

class AssetCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Computer', 'slug' => 'computer'],
            ['name' => 'Laptop', 'slug' => 'laptop'],
            ['name' => 'Monitor', 'slug' => 'monitor'],
            ['name' => 'Printer', 'slug' => 'printer'],
            ['name' => 'TV', 'slug' => 'tv'],
            ['name' => 'Speaker', 'slug' => 'speaker'],
            ['name' => 'Network Equipment', 'slug' => 'networking'],
            ['name' => 'Phone', 'slug' => 'phone'],
            ['name' => 'Tablet', 'slug' => 'tablet'],
            ['name' => 'Peripheral', 'slug' => 'peripheral'],
        ];
        foreach ($categories as $c) {
            AssetCategory::firstOrCreate(['slug' => $c['slug']], $c);
        }
    }
}
