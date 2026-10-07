<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'status', 'task_date', 'created_at', 'is_archived'];
    protected $useTimestamps    = false;

    // Get only today's tasks
    public function getTodayTasks()
    {
        return $this->where('is_archived', 0)
                    ->where('task_date', date('Y-m-d'))
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Get all tasks ordered by date
    public function getAllTasksOrdered()
    {
        return $this->where('is_archived', 0)
                    ->orderBy('task_date', 'DESC')
                    ->findAll();
    }
}
