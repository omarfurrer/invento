<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuperAdminUsersTableSeeder::class);
        $this->call(MeasurementUnitsTableSeeder::class);
        $this->call(ItemCategoriesTableSeeder::class);
    }

}
