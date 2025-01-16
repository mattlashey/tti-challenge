<?php
namespace App\Enums;

enum ProjectStatusEnum: string
{
  case OPEN = 'open';
  case PROGRESS = 'in_progress';
  case COMPLETED = 'completed';
}