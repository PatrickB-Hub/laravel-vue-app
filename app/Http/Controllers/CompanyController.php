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
}
