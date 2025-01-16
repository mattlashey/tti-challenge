<?php
namespace App\Enums;

enum TaskStatusEnum: string
{
  case TODO = 'to_do';
  case PROGRESS = 'in_progress';
  case DONE = 'done';
}