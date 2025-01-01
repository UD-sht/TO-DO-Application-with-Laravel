<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $model;

    public function select($select = '*')
    {
        return $this->model->select($select);
    }

    public function selectRaw($select = '*')
    {
        return $this->model->selectRaw($select);
    }

    public function with($with = [])
    {
        return $this->model->with($with);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get()
    {
        return $this->model->get();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function paginate($paginate)
    {
        return $this->model->paginate($paginate);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findOrNull($id)
    {
        return $this->model->find($id);
    }

    public function create($inputs)
    {
        DB::beginTransaction();
        try {
            $record = $this->model->create($inputs);
            DB::commit();

            return $record;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return false;
        }
    }

    public function insert($inputs)
    {
        DB::beginTransaction();
        try {
            $this->model->insert($inputs);
            DB::commit();

            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            throw $e;
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
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();

            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->model->findOrFail($id)->delete();
            DB::commit();

            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();

            return false;
        }
    }

    public function findByField($field, $value = null, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }

    public function where($field, $value)
    {
        return $this->model->where($field, $value);
    }

    public function whereIn($field, $value)
    {
        return $this->model->whereIn($field, $value);
    }

    public function orderby($field, $type = 'desc')
    {
        return $this->model->orderby($field, $type);
    }

    public function pluck($field, $key)
    {
        return $this->model->pluck($field, $key);
    }

    public function firstOrCreate($attributes)
    {
        return $this->model->firstOrCreate($attributes);
    }

    public function first()
    {

        return $this->model->first();
    }

    public function updateOrCreate($attributes, $inputs = [])
    {
        return $this->model->updateOrCreate($attributes, $inputs);
    }

    public function whereHas($relation, $callback)
    {
        return $this->model->whereHas($relation, $callback);
    }

    public function query()
    {
        return $this->model->query();
    }
}
