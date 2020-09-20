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
            'category_name' => 'ファッション',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => '不動産',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => 'デスマッチ',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => '強盗',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => 'カジノ',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => 'レース',
        ];
        DB::table('categories')->updateOrInsert($data);
        
        $data = [
            'category_name' => 'その他',
        ];
        DB::table('categories')->updateOrInsert($data);
    }
}
