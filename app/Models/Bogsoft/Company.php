<?php

namespace App\Models\Bogsoft;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function departments(){
        return $this->hasMany(Department::class);
    }
}
