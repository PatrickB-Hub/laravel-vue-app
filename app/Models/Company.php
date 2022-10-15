<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class company extends Model
{
    use HasFactory;

    // Relationship to Employee
    public function employee()
    {
        return $this->hasMany(Employee::class, 'company_id');
    }
}
