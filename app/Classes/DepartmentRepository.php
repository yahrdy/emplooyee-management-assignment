<?php


namespace App\Classes;


class DepartmentRepository
{
    public function store($request)
    {
        return DepartmentRepository::create([
            'company_id' => $request->company_id,
            'name' => $request->name
        ]);
    }

    public function update($request, $department)
    {
        $department->update($request->all());
        return $department;
    }
}
