<?php

namespace Modules\TaskSchedule\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Database\QueryException;
use Modules\TaskSchedule\Models\TaskSchedule;

class TaskScheduleRepository extends BaseRepository
{
    protected $model;
    public function __construct(
        TaskSchedule $taskSchedules,
    ){
        $this->model = $taskSchedules;
    }

    public function getModalObject($id)
    {
        return $this->model
            ->where("id", $id)
            ->first();
    }
    public function taskScheduleListQuery($user)
    {
        return DB::table($this->model->getTable() . ' as t1')
        ->select('*')
        ->where('user_code', $user);
    }
    public function getQuickStats($user)
    {
        $query = DB::table($this->model->getTable())
              ->selectRaw('
              count(*) as total_tasks,
              count(case when status = "pending" then 1 end) as pending_tasks,
              count(case when status = "in_progress" then 1 end) as in_progress_tasks,
              count(case when status = "completed" then 1 end) as completed_tasks,
              count(case when status = "overdue" then 1 end) as overdue_tasks
              ')
              ->where('user_code', $user)
              ->first();
        return $query;
    }
    public function getUpcomingDeadlines($user)
    {
        return $this->model
            ->where('user_code', $user)
            ->where('due_date', '>=', now())
            ->orderBy('due_date', 'asc')
            ->limit(5)
            ->get()
            ->map(function($task) {
                $task->due_date = Carbon::parse($task->due_date);
                return $task;
            });
    }
    public function create($inputs)
    {
        DB::beginTransaction();
        try {
            $record = $this->model->create($inputs);
            DB::commit();

            return $record;
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function update($id, $inputs)
    {
        DB::beginTransaction();
        try {
            $record = $this->model->findOrFail($id);
            $record->fill($inputs)->save();
            DB::commit();
            return $record;
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }
    public function destroyTask($id)
    {
        DB::beginTransaction();
        try {
            $record = $this->getModalObject($id);
            if (!$record) {
                return false;
            }
            $record->delete();
            DB::commit();

            return $record;
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }
}
