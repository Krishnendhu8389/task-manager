@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h3 class="fw-bold mb-0">{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h3>
                </div>

                <div class="card-body p-4">
                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
                        @csrf
                        @if(isset($task)) @method('PUT') @endif

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control form-control-lg shadow-sm" 
                                value="{{ old('title', $task->title ?? '') }}" placeholder="Enter task title" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control shadow-sm" rows="5" 
                                placeholder="Enter task description">{{ old('description', $task->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select shadow-sm" required>
                                @foreach(['Pending', 'In Progress', 'Completed'] as $s)
                                    <option value="{{ $s }}" @if(old('status', $task->status ?? '') == $s) selected @endif>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Due Date</label>
                            <input type="date" name="due_date" class="form-control shadow-sm" 
                                value="{{ old('due_date', isset($task->due_date) ? $task->due_date->format('Y-m-d') : '') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">
                                {{ isset($task) ? 'Update Task' : 'Create Task' }}
                            </button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-lg rounded-pill shadow-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional Card Hover Effect -->
<style>
.card:hover {
    transform: translateY(-4px);
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
