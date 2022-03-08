<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\employee_experience;
use App\Models\employee_education;
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
        // return response()->json([
        //     'data' => $all_employees
        // ]);
        return DataTables::eloquent($all_employees)->toJson();
    }
}
