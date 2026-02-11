@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <div id="task">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Task</h3>
                    <i class="fas fa-plus"></i>
                </div>

                <div class="card-body">
                    <form id="taskForm" method="POST" action="{{ route('admin.task.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="taskTitle">Task Title *</label>
                            <input type="text" id="taskTitle" name="title" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="taskAssignee">Assign To *</label>
                                <select id="taskAssignee" name="assigned_to" class="form-control" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $e)
                                        <option value="{{ $e->id }}">{{ $e->first_name }} {{ $e->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="taskPriority">Priority *</label>
                                <select id="taskPriority" name="priority" class="form-control" required>
                                    <option value="High">High</option>
                                    <option value="Medium" selected>Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="taskStartDate">Start Date</label>
                                <input type="date" id="taskStartDate" name="start_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="taskDueDate">Due Date *</label>
                                <input type="date" id="taskDueDate" name="due_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="taskDescription">Description</label>
                            <textarea id="taskDescription" name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Task</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Task Statistics</h3>
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="card-body">
                    <p>Total: <strong>{{ $total ?? 0 }}</strong></p>
                    <p>Pending: <strong>{{ $pending ?? 0 }}</strong></p>
                    <p>In Progress: <strong>{{ $inProgress ?? 0 }}</strong></p>
                    <p>Completed: <strong>{{ $completed ?? 0 }}</strong></p>
                    <div class="chart-container">
                        <canvas id="taskChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 20px;">
            <div class="card-header">
                <h3>Task List</h3>
                <div>
                    <select id="taskStatusFilter" class="form-control" style="width:auto; display:inline-block;">
                        <option value="">All Status</option>
                        <option value="Pending" {{ $status=='Pending'?'selected':'' }}>Pending</option>
                        <option value="In Progress" {{ $status=='In Progress'?'selected':'' }}>In Progress</option>
                        <option value="Completed" {{ $status=='Completed'?'selected':'' }}>Completed</option>
                        <option value="Overdue" {{ $status=='Overdue'?'selected':'' }}>Overdue</option>
                    </select>

                    <select id="taskPriorityFilter" class="form-control" style="width:auto; display:inline-block;">
                        <option value="">All Priorities</option>
                        <option value="High" {{ $priority=='High'?'selected':'' }}>High</option>
                        <option value="Medium" {{ $priority=='Medium'?'selected':'' }}>Medium</option>
                        <option value="Low" {{ $priority=='Low'?'selected':'' }}>Low</option>
                    </select>

                    <button type="button" class="btn btn-primary" id="filterTaskBtn">Filter</button>
                </div>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Task ID</th>
                            <th>Title</th>
                            <th>Assignee</th>
                            <th>Priority</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="taskTableBody">
                        @forelse($tasks as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->title }}</td>
                                <td>{{ $t->assignee?->first_name }} {{ $t->assignee?->last_name }}</td>
                                <td>{{ $t->priority }}</td>
                                <td>{{ $t->due_date?->format('d-m-Y') }}</td>
                                <td>
                                    @if($t->is_overdue)
                                        <span class="text-danger font-weight-bold">Overdue</span>
                                    @else
                                        {{ $t->status }}
                                    @endif
                                </td>
                                <td>{{ $t->progress }}%</td>
                                <td style="display:flex; gap:6px;">
                                    <form method="POST" action="{{ route('admin.task.status', $t->id) }}">
                                        @csrf
                                        <select name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="Pending" {{ $t->status=='Pending'?'selected':'' }}>Pending</option>
                                            <option value="In Progress" {{ $t->status=='In Progress'?'selected':'' }}>In Progress</option>
                                            <option value="Completed" {{ $t->status=='Completed'?'selected':'' }}>Completed</option>
                                        </select>
                                    </form>

                                    <form method="POST" action="{{ route('admin.task.delete', $t->id) }}"
                                          onsubmit="return confirm('Delete this task?')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No tasks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $tasks->appends(['status'=>$status,'priority'=>$priority])->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('filterTaskBtn')?.addEventListener('click', function(){
    const s = document.getElementById('taskStatusFilter').value;
    const p = document.getElementById('taskPriorityFilter').value;

    const url = new URL("{{ route('admin.task.index') }}", window.location.origin);
    if(s) url.searchParams.set('status', s);
    if(p) url.searchParams.set('priority', p);

    window.location.href = url.toString();
});
</script>
@endsection
