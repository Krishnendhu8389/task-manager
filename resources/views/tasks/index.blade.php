@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Tasks</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg">+ Create Task</a>
    </div>

    <!-- Flash messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Status filter -->
    <div class="mb-4">
        <form method="GET" action="{{ route('tasks.index') }}">
            <label class="form-label me-2 fw-semibold">Filter by status:</label>
            <select name="status" onchange="this.form.submit()" class="form-select w-auto d-inline">
                <option value="">All Status</option>
                <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                <option value="In Progress" {{ request('status')=='In Progress'?'selected':'' }}>In Progress</option>
                <option value="Completed" {{ request('status')=='Completed'?'selected':'' }}>Completed</option>
            </select>
        </form>
    </div>

    @if($tasks->count())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($tasks as $task)
                @php
                    $statusClass = match($task->status) {
                        'Pending' => 'bg-warning text-dark',
                        'In Progress' => 'bg-primary text-white',
                        'Completed' => 'bg-success text-white',
                        default => 'bg-secondary text-white'
                    };
                @endphp

                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-3 hover-shadow">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $task->title }}</h5>
                            <p class="card-text text-muted mb-3">{{ $task->description ?? 'No description provided.' }}</p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="badge {{ $statusClass }} fs-6">{{ $task->status }}</span>
                                <small class="text-muted">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '-' }}</small>
                            </div>

                            <div class="mt-3 d-flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning flex-fill">Edit</a>
                                <button 
                                    class="btn btn-sm btn-danger flex-fill" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-task-id="{{ $task->id }}"
                                    data-task-title="{{ $task->title }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $tasks->links() }}
        </div>
    @else
        <p class="text-center fs-5 text-muted mt-5">No tasks found. Click "Create Task" to add your first task!</p>
    @endif
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-content rounded-4 shadow">
          <div class="modal-header border-0">
            <h5 class="modal-title fw-bold" id="deleteModalLabel">Delete Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body fs-6">
            Are you sure you want to delete the task: <strong id="taskName"></strong>?
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger rounded-pill">Yes, Delete</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Script to populate modal dynamically -->
<script>
var deleteModal = document.getElementById('deleteModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var taskId = button.getAttribute('data-task-id')
    var taskTitle = button.getAttribute('data-task-title')

    var modalTitle = deleteModal.querySelector('#taskName')
    modalTitle.textContent = taskTitle

    var form = deleteModal.querySelector('#deleteForm')
    form.action = '/tasks/' + taskId
})
</script>

<style>
.hover-shadow:hover {
    transform: translateY(-4px);
    transition: 0.3s;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
}
</style>

@endsection

