<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', '');
        $priority = $request->get('priority', '');

        $employees = Employee::select('id','first_name','last_name')->orderBy('first_name')->get();

        $q = Task::with('assignee:id,first_name,last_name')->orderBy('id','desc');

        // ✅ status filter (Overdue computed)
        if ($status === 'Overdue') {
            $q->where('status', '!=', 'Completed')
              ->whereDate('due_date', '<', now()->toDateString());
        } elseif ($status) {
            $q->where('status', $status);
        }

        if ($priority) $q->where('priority', $priority);

        $tasks = $q->paginate(config('constants.pagination_limit'));

        // ✅ stats for chart/summary
        $total = (clone $q)->count();
        $pending = Task::where('status','Pending')->count();
        $inProgress = Task::where('status','In Progress')->count();
        $completed = Task::where('status','Completed')->count();

        return view('admin.task.index', compact(
            'tasks','employees','status','priority',
            'total','pending','inProgress','completed'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'assigned_to' => 'required|integer|exists:employees,id',
            'priority' => 'required|in:High,Medium,Low',
            'start_date' => 'nullable|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $validated['title'],
            'assigned_to' => $validated['assigned_to'],
            'priority' => $validated['priority'],
            'start_date' => $validated['start_date'] ?? null,
            'due_date' => $validated['due_date'],
            'description' => $validated['description'] ?? null,
            'status' => 'Pending',
            'progress' => 0,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Task created successfully.');
    }

    // ✅ update status/progress (table action)
    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $task->status = $validated['status'];

        if (isset($validated['progress'])) {
            $task->progress = $validated['progress'];
        } else {
            // auto set progress based on status
            if ($task->status === 'Pending') $task->progress = 0;
            if ($task->status === 'In Progress' && $task->progress == 0) $task->progress = 50;
            if ($task->status === 'Completed') $task->progress = 100;
        }

        $task->completed_at = $task->status === 'Completed' ? now() : null;
        $task->save();

        return back()->with('success', 'Task updated.');
    }

    public function destroy($id)
    {
        Task::where('id', $id)->delete();
        return back()->with('success', 'Task deleted.');
    }
}
