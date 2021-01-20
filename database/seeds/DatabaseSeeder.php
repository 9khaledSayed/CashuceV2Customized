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
//        $this->call(RoleSeeder::class);
//        $this->call(NationalitySeeder::class);
//        $this->call(CompanySeeder::class);
//        $this->call(EmployeeSeeder::class);
//        $this->call(ViolationSeeder::class);

        $provider = new \App\Role([
            'name_english'  => 'Provider',
            'name_arabic'  => 'شركة مشغلة',
            'label' => 'provider',
            'type' => 'System Role',
            'company_id' => 1
        ]);
        $provider->saveWithoutEvents(['creating']);
        $abilities = \App\Ability::get();

        foreach($abilities->whereIn('category',['payroll', 'attendances']) as $ability){
            $provider->allowTo($ability);
        }
    }
}
