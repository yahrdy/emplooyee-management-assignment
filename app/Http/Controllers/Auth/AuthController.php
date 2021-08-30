<?php

namespace App\Http\Controllers\Auth;

use App\Classes\EmployeeRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Bogsoft\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request, EmployeeRepository $employeeRepository)
    {
        return $employeeRepository->login($request);
    }

    public function register(RegisterRequest $request, EmployeeRepository $employeeRepository)
    {
        $employeeRepository->store($request);
        return $employeeRepository->login($request);
    }

    public function user()
    {
        $user = auth()->user();
        return response($user);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response('Logged out');
    }
}
