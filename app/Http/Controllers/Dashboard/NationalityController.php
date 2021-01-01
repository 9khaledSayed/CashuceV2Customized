<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index(Request $request)
    {
//        $this->authorize('view_nationalities');
        if ($request->ajax()) {
            $nationality = Nationality::all();
            return response()->json($nationality);
        }
        return  view('dashboard.settings.nationalities.index');

    }

    public function create()
    {
//        $this->authorize('create_nationalities');
        return  view('dashboard.settings.nationalities.create');
    }

    public function store(Request $request)
    {
//        $this->authorize('create_nationalities');
        Nationality::create($this->validator($request));
        return redirect(route('dashboard.nationalities.index'));
    }

    public function edit(Nationality $nationality)
    {
//        $this->authorize('update_nationalities');
        return  view('dashboard.settings.nationalities.edit',compact('nationality'));
    }

    public function update(Request $request, Nationality $nationality)
    {
//        $this->authorize('update_nationalities');
        $nationality->update($this->validator($request));
        return redirect(route('dashboard.nationalities.index'));
    }


    public function destroy($id ,Request $request)
    {
//        $this->authorize('delete_nationalities');
//        if($request->ajax()){
//            Nationality::find($id)->destroy($id);
//            return response()->json([
//                'status' => true,
//                'message' => 'Item Deleted Successfully'
//            ]);
//        }
//        return redirect(route('dashboard.nationalities.index'));
    }

    public function validator(Request $request) {
        return $request->validate([
            'name_ar' => ['required', 'string', 'max:25', 'unique:nationalities'],
            'name_en' => ['required', 'string', 'max:25', 'unique:nationalities'],
        ]);
    }
}
