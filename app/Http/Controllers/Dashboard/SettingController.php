<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use anlutro\LaravelSettings\Facade as Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function setManagerID()
    {
        Setting::setExtraColumns(array(
            'company_id' => Company::companyID()
        ));
   }



    public function attendnace(Request $request)
    {
        $this->authorize('view_settings');
        $this->setManagerID();

        if ($request->post()){

            setting($request->validate([
                'work_start_date' => 'required',
                'work_end_date' => 'required',
                'overtime' => 'required',
            ]))->save();

            return redirect(route('dashboard.settings.attendance'))->with('success', 'true');
        }
        return view('dashboard.settings.attendance');
    }

    public function payrolls(Request $request)
    {
        $this->authorize('view_settings');
        $this->setManagerID();

        if ($request->post()){

            setting($request->validate([
                'operations' => 'required',
                'payroll_day' => 'required',
                'work_days' => 'required',
            ]))->save();

            return redirect(route('dashboard.settings.payrolls'))->with('success', 'true');
        }
        return view('dashboard.settings.payrolls');
    }


}
