<?php

namespace App\Http\Controllers\Dashboard;

use App\Allowance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
//        $this->authorize('view_allowances_types');
        if ($request->ajax()) {
            $allowanceTypes = Allowance::all();
            return response()->json($allowanceTypes);
        }
        return view('dashboard.settings.allowances.index');
    }



    public function store(Request $request)
    {
//        $this->authorize('view_allowances_types');
        if ( $request->ajax())
        {
            Allowance::create($this->validator($request));
        }
    }

    public function edit(Allowance $allowance)
    {
        return view('dashboard.settings.allowances.edit',compact('allowance'));
    }

    public function update(Allowance $allowance , Request $request)
    {
//        $this->authorize('view_allowances_types');
        if ( $request->ajax())
        {
            $allowance->update($this->validator($request));
        }
    }

    public function validator(Request $request)
    {
        return $request->validate([
            'name_ar'    => 'required | string',
            'name_en'    => 'required | string',
            'percentage' => 'nullable | numeric',
            'value' => 'nullable | numeric',
            'type' => 'required | integer'
        ]);
    }
}
