<?php

namespace App\Http\Controllers;
use App\Models\employee_education;
use Illuminate\Http\Request;
use DataTables;

class EmployeeEducationController extends Controller
{
    public function create(Request $request) {
        // insert employee education
        $employee_education = new employee_education;
        $employee_education->employee_id = $request->employee_id;
        $employee_education->exam = $request->exam;
        $employee_education->passing_year = $request->passing_year;
        $employee_education->result = $request->result;
        $employee_education->institution = $request->institution;
        $employee_education->save();

        if ($employee_education) {
            return response()->json('done');
        }
    }
    public function education_list() {
        $all_educations = employee_education::query();
        return DataTables::eloquent($all_educations)
        ->addIndexColumn()
        ->addColumn('actions', function ($education) {
            return "<a class='btn btn-info'  href= ''><i class='fas fa-pen'></i></a> 
                    <a class='btn btn-danger'  href= ''><i class='fas fa-trash'></i></a>";
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['actions'])
        ->make(true);
    }
}
