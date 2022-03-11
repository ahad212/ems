<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employee_education;
use App\Models\employee_experience;
class employee extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function employee_education()
    {
        return $this->hasMany(employee_education::class);
    }

    public function employee_experience()
    {
        return $this->hasMany(employee_experience::class);
    }
}
