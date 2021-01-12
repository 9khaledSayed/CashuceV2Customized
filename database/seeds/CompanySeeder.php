<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new \App\Company([
            'name_ar'      => 'Admin',
            'name_en'      => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $company->saveWithoutEvents(['creating']);

        $default = new \App\WorkShift([
            'company_id' => 1,
            'name_ar' => 'test',
            'name_en' => 'test',
            'work_days' => '[]',
            'shift_start_time' => '01:00:00',
            'shift_end_time' => '01:00:00',
            'overtime_hours' => '01:00',
        ]);

        $default->saveWithoutEvents(['creating']);

    }
}
