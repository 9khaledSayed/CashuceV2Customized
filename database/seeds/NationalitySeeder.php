<?php

use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Nationality::create([
           'name_ar' => 'saudi',
           'name_en' => 'non-saudi',
        ]);
    }
}
