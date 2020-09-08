<?php

use Illuminate\Database\Seeder;

class ReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'reason' => '社会的に不適切',
        ];
        DB::table('reasons')->updateOrInsert($data);
        
        $data = [
            'reason' => '法令違反',
        ];
        DB::table('reasons')->updateOrInsert($data);
        
        $data = [
            'reason' => 'スパムの疑い',
        ];
        DB::table('reasons')->updateOrInsert($data);
        
        $data = [
            'reason' => '宣伝行為',
        ];
        DB::table('reasons')->updateOrInsert($data);
        
        $data = [
            'reason' => 'その他ガイドライン違反',
        ];
        DB::table('reasons')->updateOrInsert($data);
        
    }
}