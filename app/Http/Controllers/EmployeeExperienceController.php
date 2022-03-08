<?php

namespace App\Http\Controllers;
use App\Models\employee_experience;
use Illuminate\Http\Request;
use DataTables;

class EmployeeExperienceController extends Controller
{
    public function create(Request $request) {
        // insert employee experience
        $employee_experience = new employee_experience;
        $employee_experience->employee_id = $request->employee_id;
        $employee_experience->organization = $request->organization;
        $employee_experience->from_date = $request->from_date;
        $employee_experience->to_date = $request->to_date;
        $employee_experience->designation = $request->organization_designation;
        $employee_experience->duties = $request->duties;
        $employee_experience->save();

        if ($employee_experience) {
            return response()->json('done');
        }
    }
    public function experience_list() {
        $all_experience = employee_experience::query();
        return DataTables::eloquent($all_experience)
        ->addIndexColumn()
        ->addColumn('actions', function ($experience) {
            return "<a class='btn btn-info'  href= ''><i class='fas fa-pen'></i></a> 
                    <a class='btn btn-danger'  href= ''><i class='fas fa-trash'></i></a>";
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['actions'])
        ->make(true);
    }
}
