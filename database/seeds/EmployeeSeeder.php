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

        $default = new \App\WorkShift([
            'manager_id' => 1,
            'name_ar' => 'test',
            'name_en' => 'test',
            'work_days' => '[]',
            'shift_start_time' => '01:00:00',
            'shift_end_time' => '01:00:00',
            'overtime_hours' => '01:00',
        ]);

        $default->saveWithoutEvents(['creating']);
        $admin = \App\Employee::create([
            'fname_ar'      => 'Admin',
            'lname_ar'      => 'Admin',
            'fname_en'      => 'Admin',
            'lname_en'      => 'Admin',
            'birthdate'      => '2020-08-01',
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '1',
            'id_num'      => '54566546544',
            'contract_type'      => '1',
            'contract_start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'phone'      => '01021212121',
            'email' => 'admin@admin.com',
            'is_manager' => true,
            'manager_id' => null,
            'work_shift_id' => 1,
            'job_number' => 1111,
            'barcode' => '53070423',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $supervisor = \App\Employee::create([
            'fname_ar'      => 'Supervisor',
            'lname_ar'      => 'Supervisor',
            'fname_en'      => 'Supervisor',
            'lname_en'      => 'Supervisor',
            'birthdate'      => '2020-08-01',
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '0',
            'id_num'      => '54566546544',
            'contract_type'      => '1',
            'contract_start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'phone'      => '01021212121',
            'email' => 'supervisor@admin.com',
            'manager_id' => 1,
            'work_shift_id' => 1,
            'job_number' => 1112,
            'barcode' => '53070424',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $hrManager = \App\Employee::create([
            'fname_ar'      => 'hr',
            'lname_ar'      => 'hr',
            'fname_en'      => 'hr',
            'lname_en'      => 'hr',
            'birthdate'      => '2020-08-01',
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '0',
            'id_num'      => '54566546544',
            'contract_type'      => '1',
            'contract_start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'phone'      => '01021212121',
            'email' => 'hr@admin.com',
            'manager_id' => 1,
            'work_shift_id' => 1,
            'job_number' => 1113,
            'barcode' => '53070425',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $emp1 = \App\Employee::create([
            'fname_ar'      => 'employee1',
            'lname_ar'      => 'employee1',
            'fname_en'      => 'employee1',
            'lname_en'      => 'employee1',
            'birthdate'      => '2020-08-01',
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '0',
            'id_num'      => '54566546544',
            'contract_type'      => '1',
            'contract_start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'phone'      => '01021212121',
            'email' => 'emp1@admin.com',
            'manager_id' => 1,
            'work_shift_id' => 1,
            'job_number' => 1114,
            'barcode' => '53070426',
            'vacations_balance' => 30,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        $emp2 = \App\Employee::create([
            'fname_ar'      => 'Employee2',
            'lname_ar'      => 'Employee2',
            'fname_en'      => 'Employee2',
            'lname_en'      => 'Employee2',
            'birthdate'      => '2020-08-01',
            'joined_date'      => '2020-08-01',
            'nationality_id'      => '0',
            'id_num'      => '54566546544',
            'contract_type'      => '1',
            'contract_start_date'      => '2020-08-01',
            'contract_period'      => '12',
            'phone'      => '01021212121',
            'email' => 'emp2@admin.com',
            'manager_id' => 1,
            'work_shift_id' => 1,
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
