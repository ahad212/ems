<?php

namespace App\Http\Controllers;
use App\Models\employee_education;
use Illuminate\Http\Request;
use DataTables;

class EmployeeEducationController extends Controller
{
    // return education create api response
    public function create(Request $request) {

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
    
    // return educations list
    public function education_list($employee_id) {
        $where = ['employee_id' => $employee_id];
        $all_educations = employee_education::where($where);
        return DataTables::eloquent($all_educations)
        ->addIndexColumn()
        ->addColumn('actions', function ($education) {
            return "<a class='btn btn-info'  href= '/admin/{$education->employee_id}/educational-inforamations/edit/{$education->id}'><i class='fas fa-pen'></i></a> 
                    <a class='btn btn-danger'  href= '/api/v1/education_delete/{$education->id}'><i class='fas fa-trash'></i></a>";
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['actions'])
        ->make(true);
    }

    // return education edit page view
    public function edit_view($employee_id, $education_id) {
        $education = employee_education::find($education_id);
        return view('admin.pages.educations.update_education', compact(['education']));        
    }

    // return education update api response
    public function update($education_id, Request $request) {
        $education = employee_education::find($education_id);
        $education->exam = $request->exam;
        $education->passing_year = $request->passing_year;
        $education->result = $request->result;
        $education->institution = $request->institution;
        $education->save();
        
        if ($education) {
            return response()->json('edited');
        }
    }

    // delete education and back
    public function destroy($education_id) {
        $education = employee_education::find($education_id);
        $education->delete();
        if ($education) {
            return back();
        }
    }
}
