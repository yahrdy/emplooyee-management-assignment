<?php

namespace App\Http\Controllers\Bogsoft;

use App\Classes\CompanyRepository;
use App\Classes\DepartmentRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bogsoft\DepartmentStoreRequest;
use App\Http\Requests\Bogsoft\DepartmentUpdateRequest;
use App\Models\Bogsoft\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $per_page = \request('per_page') ?? 20;
        $sort = \request('sort') ?? 'created_at';
        $desc = \request('desc') ? 'desc' : 'asc';
        $query = \request('query');
        $company_id = \request('id');
        $departments = Department::orderBy($sort, $desc);
        if ($company_id) {
            $departments->where('company_id', $company_id);
        }
        if ($query) {
            $departments->whereRaw('UPPER(name) LIKE ?', ['%' . strtoupper($query) . '%']);
        }
        return $departments->paginate($per_page);
    }

    public function store(DepartmentStoreRequest $request, CompanyRepository $companyRepository)
    {
        return response($companyRepository->store($request));
    }

    public function show(Department $department)
    {
        return response($department);
    }

    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $departmentRepository = new DepartmentRepository();
        return response($departmentRepository->update($request, $department));
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response($department);
    }
}
