<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'description', 'assigned_to', 'due_date', 'status'];

    //Relationship where each task belongs to one project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
