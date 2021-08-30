<?php


namespace App\Classes;


use App\Http\Requests\Auth\UpdateEmployeeRequest;
use App\Models\Bogsoft\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    public function login($request)
    {
        $employee = Employee::where('email', $request->email)->firstOrFail();
        if (Hash::check($request->password, $employee->password)) {
            return response($employee->createToken('web-app'));
        }
        return response('Credential did not match', 401);
    }

    public function store($request)
    {
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at,
            'password' => $request->password,
            'age' => $request->age,
            'interests' => $request->interests,
        ]);
        if ($request->has('department_id')) {
            $employee->departments()->attach($request->department_id);
        }
        return $employee;
    }

    public function update($request, $employee)
    {
        $employee->update($request->all());
        return $employee;
    }
}
