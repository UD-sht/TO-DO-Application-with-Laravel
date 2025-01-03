<?php

namespace Modules\Profile\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Request\User\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(
        protected UserRepository $users,
    ) {
        $this->users = $users;
    }

    public function index(Request $request)
    {

        $user = $this->users->getModalObject(Auth::user()->user_code);
        return view('Profile::index')
            ->with([
                'user' => $user
            ]);
    }
    public function update(UpdateRequest $request, $user)
    {
        try {
            $inputs = $request->validated();
            $this->users->update($user, $inputs);
            $response = ['message' => __('message.model-updated', ['name' => 'Profile'])];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
