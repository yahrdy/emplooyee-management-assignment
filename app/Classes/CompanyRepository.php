<?php


namespace App\Classes;


use App\Models\Bogsoft\Company;

class CompanyRepository
{
    public function store($request)
    {
        return Company::create([
            'name' => $request->name
        ]);
    }

    public function update($request, $company)
    {
        $company->update($request->all());
        return $company;
    }
}
