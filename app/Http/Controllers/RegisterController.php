<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request\User\StoreRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct(
        protected UserRepository $users,
    ) {}
    public function register(Request $request)
    {
        return view('auth.register');
    }
    public function store(StoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['password'] = bcrypt($request->user_password);
        $inputs['activated_at'] = date('Y-m-d H:i:s');
        $user = $this->users->create($inputs);
        if ($user) {
            return redirect()->route('login')
                ->withSuccessMessage(__('message.model-created', ['name' => 'User']));
        } else {
            return redirect()->back()
                ->withWarningMessage(__('message.model-not-created', ['name' => 'User']));
        }
    }
}
