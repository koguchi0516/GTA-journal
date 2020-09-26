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
            'name' => 'koguchi-0516',
            'password' => Hash::make('k.61507991'),
        ];
        DB::table('admins') -> updateOrInsert($data);
    }
}
