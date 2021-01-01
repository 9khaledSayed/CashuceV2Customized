<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => false]);

Route::redirect('/', 'login');

Route::get('language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    return back();
})->name('change_language');


Route::namespace('Dashboard')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
//    ->middleware('verified')
    ->group(function(){
        Route::get('/', 'DashboardController@index')->name('index');
        Route::get('/abilities', 'AbilityController@index');
        Route::get('/violations/{violation}/additions', 'ViolationController@additions');
        Route::get('myProfile/account_info', 'ProfileController@accountInfo')->name('myProfile.account_info');
        Route::post('myProfile/update_account_info', 'ProfileController@updateAccountInfo')->name('myProfile.update_account_info');
        Route::get('myProfile/change_password', 'ProfileController@changePasswordForm')->name('myProfile.change_password');
        Route::post('myProfile/change_password', 'ProfileController@changePassword')->name('myProfile.changePassword');
        Route::get('/reports/{report}/forwardToEmployee', 'ReportController@forwardToEmployee');
        Route::get('attendances/check/{employee}', 'AttendanceController@attendanceCheck');
        Route::get('attendances/myAttendance', 'AttendanceController@myAttendance')->name('attendances.my_attendances');
        Route::get('attendances/lateNotification', 'AttendanceController@lateNotification');
        Route::get('notifications', 'NotificationController@index')->name('notifications.index');
        Route::get('notifications/mark_as_read/{id}', 'NotificationController@markAsRead')->name('notifications.mark_as_read');
        Route::get('unReadNotificationsNumber', 'NotificationController@unReadNotificationsNumber')->name('notifications.unReadNotificationsNumber');
        Route::get('employees/late_employees/{id}', 'EmployeeController@lateEmployees')->name('employees.late_employees');
        Route::post('requests/take_action/{request}', 'RequestController@takeAction')->name('requests.take_action');
        Route::get('requests/pending_requests', 'RequestController@pendingRequests')->name('requests.pending_requests');
        Route::get('requests/my_requests', 'RequestController@myRequests')->name('requests.my_requests');
        Route::get('payrolls/approve/{payroll}', 'PayrollController@approve')->name('payrolls.approve');
        Route::get('payrolls/reject/{payroll}', 'PayrollController@reject')->name('payrolls.reject');
        Route::get('payrolls/reissue/{payroll}', 'PayrollController@reissue')->name('payrolls.reissue');
        Route::get('payrolls/pending', 'PayrollController@pending')->name('payrolls.pending');
        Route::get('salaries/my_salaries', 'SalaryController@mySalaries')->name('salaries.my_salaries');
        Route::get('salaries/{salary}', 'SalaryController@show')->name('salaries.show');
        Route::any('settings/attendance', 'SettingController@attendnace')->name('settings.attendance');
        Route::any('settings/payrolls', 'SettingController@payrolls')->name('settings.payrolls');


        Route::resources([
        'employees' => 'EmployeeController',
        'violations' => 'ViolationController',
        'roles' => 'RoleController',
        'customers' => 'CustomerController',
        'employees_violations' => 'EmployeeViolationController',
        'reports' => 'ReportController',
        'conversations' => 'ConversationController',
        'messages' => 'MessageController',
        'attendances' => 'AttendanceController',
        'vacations' => 'VacationController',
        'attendance_forgottens' => 'AttendanceForgottenController',
        'requests' => 'RequestController',
        'payrolls' => 'PayrollController',
        'nationalities' => 'NationalityController',
        'allowances' => 'AllowanceController',
        'work_shifts' => 'WorkShiftController',
        'vacation_types' => 'VacationTypeController',
    ]);

});
Route::get('/foo', function (){
    Artisan::call('migrate --seed');
    dd('done');
});