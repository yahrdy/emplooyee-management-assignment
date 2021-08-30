<?php

namespace App\Models\Bogsoft;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;

class Employee extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];

    protected $hidden = ['password'];

    protected $casts = ['interests' => 'array'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }
}
