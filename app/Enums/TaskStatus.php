<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Pending = "pending";
    case DueDate = "due_date";
    case Completed = "completed";
}
