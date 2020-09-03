<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'test-admin',
            'password' => Hash::make('11111111'),
        ];
        DB::table('admins') -> updateOrInsert($data);
    }
}
