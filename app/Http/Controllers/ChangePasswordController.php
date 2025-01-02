<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Request\ChangePassword\StoreRequest;

class ChangePasswordController extends Controller
{
    protected UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function create(Request $request)
    {
        return view('auth.change_password');
    }

    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();
        DB::beginTransaction();
        try {
            $user = Auth::user();
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->withInput()
                ->with('warning_message', __('The current password is incorrect.'));
            }
            $user->password = Hash::make($request->input('new_password'));
            $this->users->update($user->user_code, ['password' => $user->password]);

            DB::commit();
            Auth::logout();
            return redirect()->route('login')
                ->with('success_message', __('Your password has been successfully changed. Please log in again.'));
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput()
                ->with('warning_message', $e->getMessage());
        }
    }
}
