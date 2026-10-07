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

    public function newTask()
    {
        return view('task_form', ['title' => 'New Task', 'task' => null, 'action' => site_url('/tasks')]);
    }

    public function createTask()
    {
        if (! $this->validateTask()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->insert([
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status') === 'completed' ? 'completed' : 'pending',
            'task_date' => $this->request->getPost('task_date'),
            'created_at' => date('Y-m-d H:i:s'),
            'is_archived' => 0,
        ]);

        return redirect()->to('/tasks')->with('success', 'Task created successfully.');
    }

    public function editTask(int $id)
    {
        $task = $this->taskModel->where('is_archived', 0)->find($id);
        if (! $task) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }

        return view('task_form', ['title' => 'Edit Task', 'task' => $task, 'action' => site_url('/tasks/' . $id)]);
    }

    public function updateTask(int $id)
    {
        $task = $this->taskModel->where('is_archived', 0)->find($id);
        if (! $task) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }
        if (! $this->validateTask()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->update($id, [
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status') === 'completed' ? 'completed' : 'pending',
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to('/tasks')->with('success', 'Task updated successfully.');
    }

    public function deleteTask(int $id)
    {
        $task = $this->taskModel->where('is_archived', 0)->find($id);
        if (! $task) {
            return redirect()->to('/tasks')->with('error', 'Task not found.');
        }
        $this->taskModel->update($id, ['is_archived' => 1]);
        return redirect()->to('/tasks')->with('success', 'Task archived successfully.');
    }

    private function validateTask(): bool
    {
        return $this->validate([
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status' => 'permit_empty|in_list[pending,completed]',
        ], [
            'title' => ['required' => 'A task title is required.'],
            'task_date' => ['required' => 'A task date is required.', 'valid_date' => 'Enter a valid task date.'],
        ]);
    }
}
