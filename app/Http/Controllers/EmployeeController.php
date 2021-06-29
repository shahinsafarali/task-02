<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeePaginationRequest;
use App\Jobs\ProcessEmployees;
use App\Models\Department;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(EmployeePaginationRequest $request, Department $department = null)
    {
        $perPage = $request->query('perPage', config('pagination.defaultPerPage'));

        $employees = EmployeeService::getEmployees($department, $perPage);

        return view('employees',
            [
                'department' => $department,
                'employees' => $employees,
                'perPage' => $perPage,
                'perPageValues' => config('pagination.allowedPerPageValues')
            ]
        );
    }

    public function create(Request $request)
    {
        $request->validate(['employees' => 'required|mimes:application/xml,xml']);

        $path = $request->file('employees')->store('imports');
        ProcessEmployees::dispatch($path);

        return redirect(route('employees.index'))->with('message', 'Your import request has been added to the queue.');
    }
}




