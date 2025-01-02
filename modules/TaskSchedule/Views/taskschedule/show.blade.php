<div class="modal-header bg-warning bg-opacity-10 text-dark">
    <h5 class="mb-0 modal-title fs-6 fw-bold" id="openModalLabel">View Task</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="mb-2 row">
        <div class="col-lg-3">
            <div class="d-flex align-items-center h-100">
                <label for="task_name" class="m-0">Task Name</label>
            </div>
        </div>
        <div class="col-lg-9">
            <p>{{ $task->task_name }}</p>
        </div>
    </div>

    <div class="mb-2 row">
        <div class="col-lg-3">
            <div class="d-flex align-items-center h-100">
                <label for="priority" class="m-0">Priority</label>
            </div>
        </div>
        <div class="col-lg-9">
            <p>{{ ucfirst($task->priority) }}</p>
        </div>
    </div>

    <div class="mb-2 row">
        <div class="col-lg-3">
            <div class="d-flex align-items-center h-100">
                <label for="status" class="m-0">Status</label>
            </div>
        </div>
        <div class="col-lg-9">
            <p>{{ ucfirst($task->status) }}</p>
        </div>
    </div>

    <div class="mb-2 row">
        <div class="col-lg-3">
            <div class="d-flex align-items-center h-100">
                <label for="due_date" class="m-0">Due Date</label>
            </div>
        </div>
        <div class="col-lg-9">
            <p>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
        </div>
    </div>

    <div class="mb-2 row">
        <div class="col-lg-3">
            <div class="d-flex align-items-center h-100">
                <label for="description" class="m-0">Description</label>
            </div>
        </div>
        <div class="col-lg-9">
            <p>{{ $task->description }}</p>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
