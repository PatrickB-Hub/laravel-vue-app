<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    public function show($id)
    {
        $employees = DB::table('companies')
            ->join('employees', 'companies.id', '=', 'employees.company_id')
            ->select('companies.id as company_id', 'companies.name', 'employees.id', 'employees.first_name', 'employees.last_name', 'employees.email')
            ->where('companies.id', '=', $id)
            ->get();
        return response()->json($employees);
    }
}
