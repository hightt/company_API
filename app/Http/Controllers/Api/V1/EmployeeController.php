<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

use App\Http\Resources\Api\V1\EmployeeResource;
use App\Http\Resources\Api\V1\EmployeeCollection;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EmployeeCollection(Employee::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->all());
        return response()->json(['status' => true, 'message' => "Employee data added successfully."], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());
        return response()->json(['status' => true, 'message' => "Employee data updated successfully."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId)
    {
        $employee = Employee::find($employeeId);
        if(empty($employee)) {
            return response()->json(['status' => false, 'message' => sprintf("Employee with ID: %s not found.", $employeeId)], 400);
        }

        $employee->delete();
        return response()->json(['status' => true, 'message' => "Employee data deleted successfully."], 200);
    }

    /**
     * Get company that belongs to the specified employee
     *
     * @param  mixed $employeeId
     * @return Object
     */
    public function getCompany($employeeId)
    {
        $employee = Employee::find($employeeId);
        if(empty($employee)) {
            return response()->json(['status' => false, 'message' => sprintf("Nie znaleziono pracownika o ID: %s", $employeeId)], 400);
        }

        return $employee->company()->first();
    }
}
