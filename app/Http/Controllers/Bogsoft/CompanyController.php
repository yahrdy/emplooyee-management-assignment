<?php

namespace App\Http\Controllers\Bogsoft;

use App\Classes\CompanyRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bogsoft\CompanyStoreRequest;
use App\Http\Requests\Bogsoft\CompanyUpdateRequest;
use App\Models\Bogsoft\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $per_page = \request('per_page') ?? 20;
        $sort = \request('sort') ?? 'created_at';
        $desc = \request('desc') ? 'desc' : 'asc';
        $query = \request('query');
        $companies = Company::orderBy($sort, $desc);
        if ($query) {
            $companies->whereRaw('UPPER(name) LIKE ?', ['%' . strtoupper($query) . '%']);
        }
        return $companies->paginate($per_page);
    }

    public function store(CompanyStoreRequest $request, CompanyRepository $companyRepository)
    {
        return response($companyRepository->store($request));
    }

    public function show(Company $company)
    {
        return response($company);
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $companyRepository = new CompanyRepository();
        return response($companyRepository->update($request, $company));
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response($company);
    }
}
