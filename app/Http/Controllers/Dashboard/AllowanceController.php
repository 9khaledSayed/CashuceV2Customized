<?php

namespace App\Http\Controllers\Dashboard;

use App\Allowance;
use App\Http\Controllers\Controller;
use App\Rules\PresentedAlone;
use App\Rules\RequiredIfNull;
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

    public function create()
    {
        return view('dashboard.settings.allowances.create');
    }


    public function store(Request $request)
    {
//        $this->authorize('view_allowances_types');
        Allowance::create($this->validator($request));
        return redirect(route('dashboard.allowances.index'));
    }

    public function edit(Allowance $allowance)
    {
        return view('dashboard.settings.allowances.edit',compact('allowance'));
    }

    public function update(Allowance $allowance , Request $request)
    {
//        $this->authorize('view_allowances_types');
        $allowance->update($this->validator($request, $allowance->id));
        return redirect(route('dashboard.allowances.index'));
    }


    public function destroy( Request $request , Allowance $allowance)
    {
        $this->authorize('delete_roles');

        if($request->ajax() && !$allowance->is_basic){
            $allowance->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Can\'t Delete Basic Allowance'
            ]);
        }

    }

    public function validator(Request $request, $id = null)
    {

        $rules = Allowance::$rules;

        array_push($rules['percentage'], new PresentedAlone($request->value));
        array_push($rules['value'], new RequiredIfNull($request));

        if($id){
            $rules['name_ar'] = ($rules['name_ar'] . ',name_ar,' . $id);
            $rules['name_en'] = ($rules['name_en'] . ',name_en,' . $id);
        }
        return $request->validate($rules);
    }
}
