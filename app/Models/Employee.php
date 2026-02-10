<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'specialization', 'job_title', 'status', 'tasks_count'];

    // علاقة المهندس بالمشاريع
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}