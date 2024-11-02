<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;

class TaskController extends Controller
{
    protected Collection $taskStatuses;
    protected Collection $users;
    protected Collection $labels;

    public function __construct()
    {
        $this->taskStatuses = TaskStatus::all();
        $this->users = User::all();
        $this->labels = Label::all();
    }

    public function index(Request $request, Task $task)
    {
        $filters = $request->input('filter', []);

        $tasks = Task::query()
            ->filterByStatus($filters['status_id'] ?? null)
            ->filterByCreatedBy($filters['created_by_id'] ?? null)
            ->filterByAssignedTo($filters['assigned_to_id'] ?? null)
            ->paginate(15);

        return view('tasks.index', [
            'task' => new Task(),
            'tasks' => $tasks,
            'taskStatuses' => $this->taskStatuses,
            'users' => $this->users,
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return view('tasks.create', [
            'task' => new Task(),
            'taskStatuses' => $this->taskStatuses,
            'users' => $this->users,
            'labels' => $this->labels
        ]);
    }

    public function store(TaskRequest $request)
    {
        $this->saveTask(new Task(), $request, auth()->id());
        flash(__('Задача успешно создана'))->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        $task = Task::findOrFail($task->id);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => Task::findOrFail($task->id),
            'taskStatuses' => $this->taskStatuses,
            'users' => $this->users,
            'labels' => $this->labels
        ]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->saveTask($task, $request);
        flash(__('Задача успешно изменена'))->success();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();
            flash(__('Задача успешно удалена'))->success();
        } catch (\Exception $e) {
            flash(__('Не удалось удалить задачу'))->error();
        }
        return redirect()->route('tasks.index');
    }

    public function saveTask(Task $task, TaskRequest $request, mixed $author_id = null)
    {
        $validated = $request->validated();
        $task->fill($validated);
        if ($author_id !== null) {
            $task->created_by_id = $author_id;
        }
        $task->save();
        $task->labels()->sync($validated['labels']);
    }
}
