<div class="modal-header bg-warning bg-opacity-10 text-dark">
    <h5 class="mb-0 modal-title fs-6 fw-bold" id="openModalLabel">Edit Task</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{!! route('todo.update', $task->id) !!}" method="post" enctype="multipart/form-data" id="taskForm" autocomplete="off">
    @csrf
    @method('PUT')  <!-- Method for updating -->
    <div class="modal-body">
        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="id-title" class="m-0 required-label">Task Name</label>
                </div>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="title" id="id-title" value="{{ old('title', $task->title) }}" required>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="id-priority" class="m-0 required-label">Priority</label>
                </div>
            </div>
            <div class="col-lg-9">
                <select name="priority" id="id-priority" class="select2 form-control form-select" tabindex="2">
                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="id-status" class="m-0 required-label">Status</label>
                </div>
            </div>
            <div class="col-lg-9">
                <select name="status" id="id-status" class="select2 form-control form-select" tabindex="3">
                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="overdue" {{ old('status', $task->status) == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="due_date" class="m-0 required-label">Due Date</label>
                </div>
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" tabindex="4">
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="description" class="m-0 required-label">Description</label>
                </div>
            </div>
            <div class="col-lg-9">
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $task->description) }}</textarea>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-warning" value="save">{{ __('label.save') }}</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</form>
