<?php

use Illuminate\Database\Seeder;

class PurposesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'purpose_name' => 'フレンド募集',
        ];
        DB::table('purposes')->updateOrInsert($data);
        
        $data = [
            'purpose_name' => 'ジョブ仲間募集',
        ];
        DB::table('purposes')->updateOrInsert($data);
        
        $data = [
            'purpose_name' => '対戦',
        ];
        DB::table('purposes')->updateOrInsert($data);
        
        $data = [
            'purpose_name' => '強盗',
        ];
        DB::table('purposes')->updateOrInsert($data);
        
        $data = [
            'purpose_name' => 'ボイスチャット',
        ];
        DB::table('purposes')->updateOrInsert($data);
        
        $data = [
            'purpose_name' => 'その他',
        ];
        DB::table('purposes')->updateOrInsert($data);
    }
}
