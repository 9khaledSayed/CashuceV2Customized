<?php

namespace App\Http\Controllers\Dashboard;

use App\Department;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            $departments = Section::get();
            return response()->json($departments);
        }
        return view('dashboard.sections.index');
    }

    public function create()
    {
        $departments = Department::all();
        return view('dashboard.sections.create', compact('departments'));
    }


    public function store(Request $request)
    {

        //dd($request->department_id);
        Section::create($this->validateSection());

        return redirect('/dashboard/sections');
    }


    public function show(Section $section)
    {
        $department = Department::all();
        return view('dashboard.sections.show', compact('section', 'department'));
    }


    public function edit(Section $section)
    {
        $departments = Department::all();
        return view('dashboard.sections.edit', compact('section', 'departments'));
    }


    public function update(Section $section)
    {
        $section->update($this->validateSection());

        return redirect(route('dashboard.sections.index'));
    }


    public function destroy(Request $request,Section $section)
    {
        if($request->ajax()){
            $section->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.sections.index'));
    }

    public function validateSection()
    {
        return request()->validate([
            'name_ar'       => 'required',
            'name_en'       => 'required',
            'department_id' => 'required'
        ]);
    }
}
