<?php

namespace App\Http\Controllers\Bogsoft;

use App\Classes\EmployeeRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Bogsoft\UpdateEmployeeRequest;
use App\Models\Bogsoft\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $per_page = \request('per_page') ?? 20;
        $sort = \request('sort') ?? 'created_at';
        $desc = \request('desc') ? 'desc' : 'asc';
        $query = \request('query');
        $departmentId = \request('id');
        $employees = Employee::orderBy($sort, $desc);
        if ($departmentId) {
            $employees =  $employees->whereHas('departments',function ($query) use ($departmentId) {
                $query->where('department_id',$departmentId);
            });
        }
        if ($query) {
            $employees->whereRaw('UPPER(first_name) LIKE ?', ['%' . strtoupper($query) . '%']);
            $employees->orWhereRaw('UPPER(middle_name) LIKE ?', ['%' . strtoupper($query) . '%']);
            $employees->orWhereRaw('UPPER(last_name) LIKE ?', ['%' . strtoupper($query) . '%']);
        }
        return $employees->paginate($per_page);
    }

    public function store(RegisterRequest $request, EmployeeRepository $employeeRepository)
    {
        return response($employeeRepository->store($request));
    }

    public function show(Employee $employee)
    {
        return response($employee);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employeeRepository = new EmployeeRepository();
        return response($employeeRepository->update($request, $employee));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response($employee);
    }
}
