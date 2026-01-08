@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h3 class="fw-bold mb-0">Edit Task</h3>
                </div>

                <div class="card-body p-4">
                    <!-- Flash Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control form-control-lg shadow-sm" 
                                value="{{ old('title', $task->title) }}" placeholder="Enter task title" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control shadow-sm" rows="5" 
                                placeholder="Enter task description">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select shadow-sm" required>
                                @foreach(['Pending', 'In Progress', 'Completed'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $task->status) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Due Date</label>
                            <input type="date" name="due_date" class="form-control shadow-sm" 
                                value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">Update Task</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-lg rounded-pill shadow-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Hover shadow for card -->
<style>
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection



