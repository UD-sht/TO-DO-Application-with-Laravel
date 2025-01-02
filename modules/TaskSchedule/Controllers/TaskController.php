<?php

namespace Modules\TaskSchedule\Controllers;

use Exception;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Modules\TaskSchedule\Models\TaskSchedule;
use Modules\TaskSchedule\Requests\StoreRequest;
use Modules\TaskSchedule\Requests\UpdateRequest;
use Modules\TaskSchedule\Repositories\TaskScheduleRepository;

class TaskController extends Controller
{
    public function __construct(
        protected TaskScheduleRepository $taskSchedules,
        protected Helper $helper
    ) {}

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tasks = $this->taskSchedules->taskScheduleListQuery();

            return DataTables::of($tasks)
                ->addIndexColumn()
                ->addColumn('task_name', function ($row) {
                    return $row->task_name;
                })
                ->addColumn('status', function ($row) {
                    return $row->status;
                })
                ->addColumn('priority', function ($row) {
                    return $row->priority;
                })
                ->addColumn('due_date', function ($row) {
                    return $row->due_date;
                })
                ->addColumn('action', function ($row) {
                    $routeParams = [
                        'id' => $row->id,
                    ];

                    $deleteObject = http_build_query([
                        'id' => $row->id,
                        '_method' => 'DELETE',
                    ]);

                    $btn = '';
                    $btn .= '<a href="' . route('todo.edit', $routeParams) .
                        '"  title="Edit" class="btn btn-outline-primary btn-sm open-modal-form"><i class="bi-pencil-square"></i></a>';

                    $btn .= '&emsp;<a href="javascript:;" class="btn btn-danger btn-sm delete-record"
                            data-description="' . $row->task_name . '" title="delete" data-object="' . $deleteObject . '"
                            data-href="' . route('todo.destroy', $routeParams) . '" >
                        <i class="bi-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('TaskSchedule::taskschedule.index');
    }

    public function create()
    {
        return view('TaskSchedule::taskschedule.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $inputs = $request->validated();
            $inputs['user_code'] = Auth::user()->user_code;
            $this->taskSchedules->create($inputs);

            $response = ['message' => __('message.model-created', ['name' => 'Task'])];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function show($id)
    {
        $task = TaskSchedule::findOrFail($id);
        return view('TaskSchedule::taskschedule.show', compact('task'));
    }

    public function edit($id)
    {
        $task = TaskSchedule::findOrFail($id);
        return view('TaskSchedule::taskschedule.edit', compact('task'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $task = TaskSchedule::findOrFail($id);
            $taskData = $request->validated();
            $taskData['user_code'] = Auth::user()->user_code;
            $task->update($taskData);

            $response = ['message' => __('message.model-updated', ['name' => 'Task'])];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function destroy(Request $request)
    {
        $flag = $this->taskSchedules->destroyTask($request->id);
        if ($flag) {
            $response = ['message' => __('message.model-deleted', ['name' => 'Task'])];

            return response()->json($response);
        }

        return response()->json(['message' => __('message.model-not-deleted', ['name' => 'Task'])], 500);
    }
}
