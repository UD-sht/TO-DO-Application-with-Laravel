<?php

namespace App\Http\Controllers;

use App\Classes\ListItem;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use DB;

class ChangePasswordController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param ListItem $listItems
     * @param UserRepository $users
     */
    public function __construct(
        ListItem $listItems,
        UserRepository $users
    )
    {
        $this->listItems = $listItems;
        $this->users = $users;
    }

    public function create(Request $request)
    {
        return view('auth.change_password');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $inputs = $request->except('_token', 'method', 'uri', 'ip');
            $bindingArray = [
                'user_code'=>auth()->user()->user_code,
                'old_password'=>$request->current_password,
                'new_password'=>$request->new_password,
                'success'=>'bindings',
                'msg'=>'bindings',
            ];

            $params = $this->users->setCustomParameters($bindingArray);
            $bindings = $this->users->setBindings(
                array(
                    'msg' => ['string'],
                    'success' => ['string'],
                ), true);

            $result = $this->users->procedureCallWithoutOperation('PKG_CALL_SECURITY.PRC_CHANGE_PASSWORD', $params, $bindings);

            if (isset($result['success'])) {
                if ($result['success'] == 'N') {
                    throw new \Exception($result['msg'], 1);
                }
            }
            DB::commit();
            \Auth::logout();
            $request->session()->flash(
                'success',
                'Password updated successfully, Please login to continue'
            );
            return redirect()->route('login');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()
                ->withWarningMessage($e->getMessage());
        }
    }
}
