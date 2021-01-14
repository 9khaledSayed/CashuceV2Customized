<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:employee,company');
    }

    public function index()
    {
        Session::put('locale', Auth::user()->lang);
        $employees = Employee::take(10)->get();
        $activities = Auth::user()->actions ?? [];
        return view('dashboard.index', compact('employees', 'activities'));
    }
}
