<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\employee;
use DataTables;

class EmployeeController extends Controller
{
    // return employee create api response
    public function create(Request $request) {
        $email_exist_already = employee::where('email', $request->email)->first();
        if ($email_exist_already) {
            return response()->json([
                'success' => false,
                'message' => 'Email already exist'
            ], 200);
        }
        $employee = new employee;
        $employee->roll = $request->roll;
        $employee->phone = $request->phone;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation = $request->designation;
        $employee->department = $request->department;
        $employee->save();

        if ($employee) {
            return response()->json([
                'success' => true,
                'message' => 'Employee added successfully'
            ], 200);
        }
    }

    // return employee list
    public function employee_list() {
        $all_employees = employee::query();
        return DataTables::eloquent($all_employees)
        ->addIndexColumn()
        ->addColumn('informations', function ($employee) {
            return "<a class='btn btn-info'  href= '/admin/{$employee->id}/educational-informations'><i class='fas fa-user-graduate'></i></a> 
                    <a class='btn btn-info'  href= '/admin/{$employee->id}/experience-informations'><i class='fas fa-briefcase'></i></a>";
        })
        ->addColumn('actions', function ($employee) {
            return "<div style='display: flex;flex-flow: row wrap; gap: 5px;'>
                        <a class='btn btn-info'  href= '/admin/employee-edit/{$employee->id}'><i class='fas fa-pen'></i></a> 
                        <a class='btn btn-warning'  href= '/admin/employee/{$employee->id}'><i class='fas fa-eye'></i></a>
                        <button class='btn btn-danger' id='$employee->id' onclick='deleteEmployee(this)'><i class='fas fa-trash'></i></button>
                    </div>";
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['informations', 'actions'])
        ->make(true);
    }

    // return employee edit page
    public function edit_view($employee_id) {
        $employee = employee::find($employee_id);
        return view('admin.pages.update_employee', compact(['employee']));
    }

    // return employee update api response
    public function update($employee_id, Request $request) {
        $employee = employee::find($employee_id);
        $employee->roll = $request->roll;
        $employee->phone = $request->phone;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation = $request->designation;
        $employee->department = $request->department;
        $employee->save();
        
        if ($employee) {
            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully'
            ], 200);
        }
    }
    
    // delete employee and back
    public function destroy($employee_id) {
        $employee = employee::find($employee_id);
        $employee->delete();
        if ($employee) {
            return back();
        }
    }

    // return single employee details

    public function employee($id) {
        $employee_details = employee::where('id', $id)
        ->with('employee_education')
        ->with('employee_experience')
        ->first();
        return response()->json($employee_details);
    }
}
