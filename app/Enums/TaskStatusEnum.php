<?php


namespace App\Enums;

enum TaskStatusEnum:string {

    case TO_DO = 'to_do';

    case IN_PROGRESS = 'in_progress';

    case QA_REVIEW  = 'qa_review';

    case DONE = 'done';

}