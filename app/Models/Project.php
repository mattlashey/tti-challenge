<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status'];

    //One to Many Relationship where each Project can have many Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
