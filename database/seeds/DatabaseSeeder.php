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
        $this->call(RoleSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(ViolationSeeder::class);

    }
}
