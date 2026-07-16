<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Device;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $company = Company::count();
        $branchCount = Branch::count();
        $deviceCount = Device::count();
        $employeeCount = Employee::count();
        return view('dashboard.index', compact('company', 'branchCount', 'deviceCount', 'employeeCount'));
    }
}