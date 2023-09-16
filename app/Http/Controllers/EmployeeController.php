<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class EmployeeController extends Controller
{
    public function import(Request $request)
    {
        $validator = Validator::make(
            array(
                'file' => $request->file,
            ),
            array(
                'file' => 'required|file|mimes:csv',
            )
        );
        if($validator->fails()){
            return $validator->messages();
        }

        Excel::import(new EmployeesImport, request()->file('file'));        
        return response()->json('All Data Imported Successfully', 201);
    }

    public function index()
    {
        $employees =  Employee::paginate(25);
        return response()->json($employees, 201);
    }
    
    public function show($id)
    {
        $employee =  Employee::find($id);
        if($employee){
            return response()->json($employee, 201);
        }else{
            return response()->json('Employee Can Not Be find', 404);
        }

    }

    public function delete($id)
    {
        $employee =  Employee::find($id);
        if($employee){
            $employee = $employee->delete();
            return response()->json('Employee Deleted Successfully', 201);
        }else{
            return response()->json('Employee Can Not Be Deleted', 404);
        }
    }

}
