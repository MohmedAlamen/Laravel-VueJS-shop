<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1, // Electronics
                'name_en' => 'Smartphone X',
                'name_ar' => 'هاتف ذكي X',
                'slug' => Str::slug('Smartphone X'),
                'description_en' => 'A powerful smartphone with a long-lasting battery and stunning camera.',
                'description_ar' => 'هاتف ذكي قوي ببطارية تدوم طويلاً وكاميرا مذهلة.',
                'price' => 699.99,
                'image' => 'smartphone-x.jpg',
            ],
            [
                'category_id' => 1, // Electronics
                'name_en' => 'Wireless Headphones',
                'name_ar' => 'سماعات رأس لاسلكية',
                'slug' => Str::slug('Wireless Headphones'),
                'description_en' => 'Noise-cancelling over-ear headphones for an immersive audio experience.',
                'description_ar' => 'سماعات رأس فوق الأذن بخاصية إلغاء الضوضاء لتجربة صوتية غامرة.',
                'price' => 199.50,
                'image' => 'headphones.jpg',
            ],
            [
                'category_id' => 2, // Clothing
                'name_en' => 'Casual T-Shirt',
                'name_ar' => 'تيشيرت كاجوال',
                'slug' => Str::slug('Casual T-Shirt'),
                'description_en' => '100% cotton t-shirt, comfortable and stylish.',
                'description_ar' => 'تيشيرت قطني 100%، مريح وأنيق.',
                'price' => 25.00,
                'image' => 'tshirt.jpg',
            ],
            [
                'category_id' => 3, // Books
                'name_en' => 'The Great Novel',
                'name_ar' => 'الرواية العظيمة',
                'slug' => Str::slug('The Great Novel'),
                'description_en' => 'A best-selling novel that explores the human condition.',
                'description_ar' => 'رواية الأكثر مبيعًا تستكشف الحالة الإنسانية.',
                'price' => 15.99,
                'image' => 'novel.jpg',
            ],
        ];

        DB::table('products')->insert($products);
    }
}
