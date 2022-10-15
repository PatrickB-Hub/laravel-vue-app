<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return response()->json($employee);
    }

    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return response()->json("Employee Updated");
    }

    public function destroy(Employee $employee)
    {
        $deleted = $employee->delete();

        return response()->json("Employee Deleted");
    }
}
