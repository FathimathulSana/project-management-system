<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'task_name',
        'description',
        'status'
    ];

    public function statuses(){
        return $this->hasMany(TaskStatusHistory::class);
    }

    public function remarks(){
        return $this->hasMany(TaskDailyRemark::class);
    }
}
