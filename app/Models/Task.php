<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status',
        'project_id'
    ];

    public function project(): BelongsTo{
        return $this->belongsTo(Project::class);
    }
}
