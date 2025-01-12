<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'title', 'description', 'assigned_to', 'due_date', 'status'];

    /**
     * A task belongs to a project.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
