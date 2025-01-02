<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $model;
    public function __construct(
        User $user
    )
    {
        $this->model = $user;
    }

    public function getUserByMobileNumber($mobileNo)
    {
        return $this->model->where('mobile_no', $mobileNo)->first();
    }

    public function getUserByCodeOrEmail($userCode)
    {
        return $this->model->where('user_code', $userCode)
            ->orWhere('email', $userCode)->first();
    }

    public function create($inputs)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->create($inputs);
            DB::commit();
            return $user;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function update($userCode, $inputs)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->findOrFail($userCode);
            $user->fill($inputs)->save();
            DB::commit();
            return $user;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e->getMessage());
            return false;
        }
    }

    public function destroy($userCode)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->findOrFail($userCode);
            $user->delete();
            DB::commit();
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return false;
        }
    }
}
