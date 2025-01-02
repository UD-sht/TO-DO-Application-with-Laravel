<?php

namespace Modules\TaskSchedule\Repositories;

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

    public function taskScheduleListQuery()
    {
        return DB::table($this->model->getTable() . ' as t1')
        ->select('*');
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
