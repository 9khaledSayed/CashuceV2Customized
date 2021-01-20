<?php

use Illuminate\Database\Seeder;

class   RoleSeeder extends Seeder
{
    protected $companyID;
    public function __construct($companyID = 1)
    {
        $this->companyID= $companyID;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'roles',
            'users',
            'violations',
            'employees',
            'employees_violations',
            'reports',
            'conversations',
        ];

        foreach ($categories as $category) {
            \App\Ability::create([
                'name'  => 'view_' . $category,
                'label' => 'View ' . ucfirst(str_replace('_', ' ', $category)),
                'category' => $category
            ]);
            \App\Ability::create([
                'name'  => 'show_' . $category,
                'label' => 'Show ' . ucfirst(str_replace('_', ' ', $category)),
                'category' => $category
            ]);
            \App\Ability::create([
                'name'  => 'create_' . $category,
                'label' => 'Create ' . ucfirst(str_replace('_', ' ', $category)),
                'category' => $category
            ]);
            \App\Ability::create([
                'name'  => 'update_' . $category,
                'label' => 'Update ' . ucfirst(str_replace('_', ' ', $category)),
                'category' => $category
            ]);
            \App\Ability::create([
                'name'  => 'delete_' . $category,
                'label' => 'Delete ' . ucfirst(str_replace('_', ' ', $category)),
                'category' => $category
            ]);

        }

        //payrolls abilities
        \App\Ability::create([
            'name'  => 'view_payrolls',
            'label' => 'View Payrolls',
            'category' => 'payrolls'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_salaries',
            'label' => 'View My Salaries',
            'category' => 'payrolls'
        ]);
        \App\Ability::create([
            'name'  => 'show_payrolls',
            'label' => 'Show Payrolls',
            'category' => 'payrolls'
        ]);
        \App\Ability::create([
            'name'  => 'create_payrolls',
            'label' => 'Create Payrolls',
            'category' => 'payrolls'
        ]);

        \App\Ability::create([
            'name'  => 'proceed_payrolls',
            'label' => 'Proceed Payrolls',
            'category' => 'payrolls'
        ]);

        //requests
        \App\Ability::create([
            'name'  => 'view_requests',
            'label' => 'View Requests',
            'category' => 'requests'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_requests',
            'label' => 'View My Requests',
            'category' => 'requests'
        ]);
        \App\Ability::create([
            'name'  => 'show_requests',
            'label' => 'Show Requests',
            'category' => 'requests'
        ]);
        \App\Ability::create([
            'name'  => 'proceed_requests',
            'label' => 'Proceed Requests',
            'category' => 'requests'
        ]);

        \App\Ability::create([
            'name'  => 'delete_requests',
            'label' => 'Delete Requests',
            'category' => 'requests'
        ]);

        //employees services
        \App\Ability::create([
            'name'  => 'create_vacation_request',
            'label' => 'Create Vacation Request',
            'category' => 'employees_services'
        ]);
        \App\Ability::create([
            'name'  => 'create_attendance_record_forgotten_request',
            'label' => 'Create Attendance Record Forgotten Request',
            'category' => 'employees_services'
        ]);

        //attendances
        \App\Ability::create([
            'name'  => 'view_attendance_record_page',
            'label' => 'View Attendance Record Page',
            'category' => 'attendances'
        ]);
        \App\Ability::create([
            'name'  => 'view_attendance_sheet',
            'label' => 'View Attendance Sheet',
            'category' => 'attendances'
        ]);
        \App\Ability::create([
            'name'  => 'view_my_attendance_history',
            'label' => 'View My Attendance History',
            'category' => 'attendances'
        ]);

        // Settings
        \App\Ability::create([
            'name'  => 'view_settings',
            'label' => 'View Settings',
            'category' => 'settings'
        ]);





        $superAdmin = new \App\Role([
            'name_english'  => 'Super Admin',
            'name_arabic'  => 'المدير التنفيذي',
            'label' => 'Super Admin',
            'type' => 'System Role',
            'company_id' => $this->companyID
        ]);
        $user = new \App\Role([
            'name_english'  => 'Company',
            'name_arabic'  => 'شركة',
            'label' => 'Company',
            'type' => 'System Role',
            'company_id' => $this->companyID
        ]);
        $Hr = new \App\Role([
            'name_english'  => 'HR',
            'name_arabic'  => 'مدير الموارد البشرية',
            'label' => 'HR',
            'type' => 'System Role',
            'company_id' => $this->companyID
        ]);
        $provider = new \App\Role([
            'name_english'  => 'Provider',
            'name_arabic'  => 'شركة مشغلة',
            'label' => 'provider',
            'type' => 'System Role',
            'company_id' => $this->companyID
        ]);
        $supervisor = new \App\Role([
            'name_english'  => 'Supervisor',
            'name_arabic'  => 'المدير المباشر',
            'label' => 'Supervisor',
            'type' => 'System Role',
            'company_id' => $this->companyID
        ]);
        $employee = new \App\Role([
            'name_english'  => 'Employee',
            'name_arabic'  => 'موظف',
            'label' => 'Employee',
            'type' => 'System Role',
            'company_id' => $this->companyID
        ]);

        $superAdmin->saveWithoutEvents(['creating']);
        $user->saveWithoutEvents(['creating']);
        $Hr->saveWithoutEvents(['creating']);
        $provider->saveWithoutEvents(['creating']);
        $supervisor->saveWithoutEvents(['creating']);
        $employee->saveWithoutEvents(['creating']);

        $abilities = \App\Ability::get();

        foreach($abilities as $ability){
            $superAdmin->allowTo($ability);
        }


        foreach($abilities->whereIn('category',[
            'roles',
            'employees',
            'employees_violations',
            'reports',
            'conversations',
            'payrolls',
            'requests',
            'employees_services',
            'attendances'
        ]) as $ability){
            $user->allowTo($ability);
        }

        foreach($abilities->whereIn('category',[
            'employees',
            'employees_violations',
            'reports',
            'conversations',
            'payrolls',
            'requests',
            'employees_services',
            'attendances']) as $ability){
            $Hr->allowTo($ability);
        }

        foreach($abilities->whereIn('category',['reports',
            'requests',
            'employees_services',
            'attendances'
        ]) as $ability){
            $supervisor->allowTo($ability);
        }

        foreach($abilities->whereIn('category',['payroll', 'attendances']) as $ability){
            $provider->allowTo($ability);
        }

        foreach($abilities->whereIn('category',['conversations','payrolls',
            'requests',
            'employees_services',
            'attendances']) as $ability){
            $employee->allowTo($ability);
        }


    }
}
