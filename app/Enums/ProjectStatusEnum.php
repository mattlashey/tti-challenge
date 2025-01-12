<?php


namespace App\Enums;

enum ProjectStatusEnum:string {

    case OPEN = 'open';

    case IN_PROGRESS = 'in_progress';

    case COMPLETED = 'completed';

}