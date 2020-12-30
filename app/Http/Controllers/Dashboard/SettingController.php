<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use anlutro\LaravelSettings\Facade as Setting;

class SettingController extends Controller
{
    public function __construct()
    {

    }

    public function attendnace(Request $request)
    {
        $employee = auth()->user();
        $managerId = ($employee->is_manager)? $employee->id:$employee->manager->id;
        Setting::setExtraColumns(array(
            'manager_id' => $managerId
        ));
        if ($request->post()){
            unset($request['_token']);
            setting($request->all())->save();
            return redirect(route('dashboard.settings.attendance'))->with('success', 'true');
        }
        return view('dashboard.settings.attendance');
    }

    public function payrolls(Request $request)
    {
        $employee = auth()->user();
        $managerId = ($employee->is_manager)? $employee->id:$employee->manager->id;
        Setting::setExtraColumns(array(
            'manager_id' => $managerId
        ));
        if ($request->post()){
            unset($request['_token']);
            setting($request->all())->save();
            return redirect(route('dashboard.settings.payrolls'))->with('success', 'true');
        }
        return view('dashboard.settings.payrolls');
    }
}
