<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmployeeViolation;
use Faker\Generator as Faker;

$factory->define(EmployeeViolation::class, function (Faker $faker) {
    return [
        'employee_id' => 3,
        'violation_id' => 20,
        'company_id' => 1,
        'repeats' => 4,
        'deduction' => 300,
        'date' => $faker->date(),
    ];
});
