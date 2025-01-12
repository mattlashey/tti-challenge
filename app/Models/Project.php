<?php

namespace App\Models;

// use App\Enums\ProjectStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use SoftDeletes, HasFactory;

    //to allow fillable for all attributes
    protected $guarded = [];


    // protected $casts = [
    //     'status' => ProjectStatusEnum::class
    // ];


    /**
     * Get the comments for the blog post.
     */
    public function tasks(): HasMany
    {   
        return $this->hasMany(Task::class);
    }
}
