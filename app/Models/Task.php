<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    const STATUS_TO_DO = 'to_do';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

}
