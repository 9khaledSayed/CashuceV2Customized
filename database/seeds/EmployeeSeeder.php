<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = \App\Employee::create([
            'name_in_arabic' => 'admin',
            'name_in_english' => 'admin',
            'email' => 'admin@admin.com',
            'is_manager' => true,
            'manager_id' => null,
            'job_number' => 1111,
            'barcode' => '53070423',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $supervisor = \App\Employee::create([
            'name_in_arabic' => 'supervisor',
            'name_in_english' => 'supervisor',
            'email' => 'supervisor@admin.com',
            'manager_id' => 1,
            'job_number' => 1112,
            'barcode' => '53070424',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $hrManager = \App\Employee::create([
            'name_in_arabic' => 'hr',
            'name_in_english' => 'hr',
            'email' => 'hr@admin.com',
            'manager_id' => 1,
            'job_number' => 1113,
            'barcode' => '53070425',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $emp1 = \App\Employee::create([
            'name_in_arabic' => 'emp1',
            'name_in_english' => 'emp1',
            'email' => 'emp1@admin.com',
            'manager_id' => 1,
            'job_number' => 1114,
            'barcode' => '53070426',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $emp2 = \App\Employee::create([
            'name_in_arabic' => 'emp2',
            'name_in_english' => 'emp2',
            'email' => 'emp2@admin.com',
            'manager_id' => 1,
            'job_number' => 1116,
            'barcode' => '53070427',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole('Super Admin');
        $supervisor->assignRole('Supervisor');
        $hrManager->assignRole('HR');
        $emp1->assignRole('Employee');
        $emp2->assignRole('Employee');
    }
}
