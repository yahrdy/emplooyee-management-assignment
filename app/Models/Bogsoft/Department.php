<?php

namespace App\Models\Bogsoft;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
