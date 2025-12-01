<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'name_en' => 'Electronics',
                'name_ar' => 'إلكترونيات',
                'slug' => Str::slug('Electronics'),
            ],
            [
                'name_en' => 'Clothing',
                'name_ar' => 'ملابس',
                'slug' => Str::slug('Clothing'),
            ],
            [
                'name_en' => 'Books',
                'name_ar' => 'كتب',
                'slug' => Str::slug('Books'),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
