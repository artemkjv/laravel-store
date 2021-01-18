<?php

namespace Database\Seeders;

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
        $this->call(CategorySeeder::class);
        $this->command->info('Таблица категорий загружена данными!');

        $this->call(BrandSeeder::class);
        $this->command->info('Таблица брендов загружена данными!');

        $this->call(ProductSeeder::class);
        $this->command->info('Таблица товаров загружена данными!');
    }
}
