<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:employee,company');
    }

    public function index()
    {
        $employees = Employee::take(10)->get();
        return view('dashboard.index', compact('employees'));
    }
}
