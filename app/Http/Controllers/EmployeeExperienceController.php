<?php

namespace App\Http\Controllers;
use App\Models\employee_experience;
use Illuminate\Http\Request;
use DataTables;

class EmployeeExperienceController extends Controller
{
    // return experience create api response
    public function create(Request $request) {
        $employee_experience = new employee_experience;
        $employee_experience->employee_id = $request->employee_id;
        $employee_experience->organization = $request->organization;
        $employee_experience->from_date = $request->from_date;
        $employee_experience->to_date = $request->to_date;
        $employee_experience->designation = $request->organization_designation;
        $employee_experience->duties = $request->duties;
        $employee_experience->save();

        if ($employee_experience) {
            return response()->json([
                'success' => true,
                'message' => 'Employee experience added successfully'
            ], 200);
        }
    }

    // return experience list
    public function experience_list($employee_id) {
        $where = ['employee_id' => $employee_id];
        $all_experience = employee_experience::where($where);
        return DataTables::eloquent($all_experience)
        ->addIndexColumn()
        ->addColumn('actions', function ($experience) {
            return "<a class='btn btn-info'  href= '/admin/{$experience->employee_id}/experience-inforamations/edit/{$experience->id}'><i class='fas fa-pen'></i></a> 
            <button class='btn btn-danger' id='$experience->id' onclick='deleteExperience(this)'><i class='fas fa-trash'></i></button>";
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['actions'])
        ->make(true);
    }

    // return experience edit page
    public function edit_view($employee_id, $experience_id) {
        $experience = employee_experience::find($experience_id);
        return view('admin.pages.experiences.update_experience', compact(['experience']));
    }

    // return experience update api response
    public function update($experience_id, Request $request) {
        $experience = employee_experience::find($experience_id);
        $experience->organization = $request->organization;
        $experience->from_date = $request->from_date;
        $experience->to_date = $request->to_date;
        $experience->designation = $request->organization_designation;
        $experience->duties = $request->duties;
        $experience->save();
        
        if ($experience) {
            return response()->json([
                'success' => true,
                'message' => 'Employee experience updated successfully'
            ], 200);
        }
    }
    
    // delete experience and back
    public function destroy($experience_id) {
        $experience = employee_experience::find($experience_id);
        $experience->delete();
        if ($experience) {
            return back();
        }
    }
}
