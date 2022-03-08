<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\employee;
use DataTables;

class EmployeeController extends Controller
{
    public function create(Request $request) {
        // insert employee
        $employee = new employee;
        $employee->roll = $request->roll;
        $employee->phone = $request->phone;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation = $request->designation;
        $employee->department = $request->department;
        $employee->save();

        if ($employee) {
            return response()->json('done');
        }
    }
    public function employee_list() {
        $all_employees = employee::query();
        return DataTables::eloquent($all_employees)
        ->addIndexColumn()
        ->addColumn('informations', function ($employee) {
            return "<a class='btn btn-info'  href= '/admin/{$employee->id}/educational-informations'><i class='fas fa-user-graduate'></i></a> 
                    <a class='btn btn-info'  href= '/admin/{$employee->id}/experience-informations'><i class='fas fa-briefcase'></i></a>";
        })
        ->addColumn('actions', function ($employee) {
            return "<div style='display:flex;flex-wrap: wrap; row-gap: 5px;'>
                        <a class='btn btn-info'  href= ''><i class='fas fa-pen'></i></a> 
                        <a class='btn btn-warning'  href= ''><i class='fas fa-eye'></i></a>
                        <a class='btn btn-danger'  href= ''><i class='fas fa-trash'></i></a>
                    </div>";
        })
        ->orderColumn('id', '-id $1')
        ->rawColumns(['informations', 'actions'])
        ->make(true);
    }
}
