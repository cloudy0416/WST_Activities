<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class MainController extends BaseController
{
    protected $taskModel;
    protected $userModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
        $this->userModel = new UserModel();
    }

    // Welcome / Dashboard: Today's tasks
    public function index()
    {
        $data['tasks'] = $this->taskModel->getTodayTasks();
        $data['title'] = "Today's Tasks";
        return view('welcome_page', $data);
    }

    // Task List: All tasks
    public function tasks()
    {
        $data['tasks'] = $this->taskModel->getAllTasksOrdered();
        $data['title'] = "All Task List";
        return view('task_list', $data);
    }

    // Profile Page
    public function profile()
    {
        $data['user'] = $this->userModel->getDemoUser();
        $data['title'] = "User Profile";
        return view('profile', $data);
    }

    // About Page
    public function about()
    {
        $data['title'] = "About Developer";
        return view('about', $data);
    }
}