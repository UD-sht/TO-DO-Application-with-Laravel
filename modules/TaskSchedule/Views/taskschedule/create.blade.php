<div class="modal-header bg-warning bg-opacity-10 text-dark">
    <h5 class="mb-0 modal-title fs-6 fw-bold" id="openModalLabel">Add Task</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{!! route('todo.store') !!}" method="post" enctype="multipart/form-data" id="taskForm" autocomplete="off">
    @csrf
    <div class="modal-body">
        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="" class="m-0 required-label">Task Name</label>
                </div>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="title" id="id-title" tabindex="1" required>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="" class="m-0 required-label">Priority</label>
                </div>
            </div>
            <div class="col-lg-9">
                <select name="priority" id="id-priority" class="select2 form-control form-select" tabindex="2">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="" class="m-0 required-label">Status</label>
                </div>
            </div>
            <div class="col-lg-9">
                <select name="status" id="id-status" class="select2 form-control form-select" tabindex="3">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="overdue">Overdue</option>
                </select>
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="" class="m-0 required-label">Due Date</label>
                </div>
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" name="due_date" id="due_date">
            </div>
        </div>

        <div class="mb-2 row">
            <div class="col-lg-3">
                <div class="d-flex align-items-center h-100">
                    <label for="" class="m-0 required-label">Description</label>
                </div>
            </div>
            <div class="col-lg-9">
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
        </div>

        {{-- <div class="mb-3 row">
            <label for="user_code" class="m-0 required-label">User</label>
            <div class="col-lg-9">
                <select class="form-control" name="user_code" id="user_code" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->user_code }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-warning" value="save">{{ __('label.save') }}</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</form>
