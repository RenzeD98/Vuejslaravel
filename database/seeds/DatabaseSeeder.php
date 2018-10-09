<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Kaas',
            ],
            [
                'name' => 'Ham',
            ],
            [
                'name' => 'Banaan',
            ],
        ]);
    }
}
