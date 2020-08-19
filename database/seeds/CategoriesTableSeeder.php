<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'category_name' => 'ストーリー',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => 'オンライン',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => '乗り物',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => '洋服',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => '不動産',
        ];
        DB::table('categories')->updateOrInsert($data);
    }
}
