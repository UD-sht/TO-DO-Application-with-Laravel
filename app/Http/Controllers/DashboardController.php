<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\TaskSchedule\Repositories\TaskScheduleRepository;

class DashboardController extends Controller
{
    protected $taskSchedules;
    public function __construct(
        TaskScheduleRepository $taskSchedules,
    ){
        $this->taskSchedules = $taskSchedules;
    }
    public function index(Request $request)
    {
        $user = Auth::user()->user_code;

        $quickStat = $this->taskSchedules->getQuickStats($user);
        $upcomingTasks = $this->taskSchedules->getUpcomingDeadlines($user);

        return view('dashboard')->with([
            'quickStat' => $quickStat,
            'upcomingTasks' => $upcomingTasks,
        ]);
    }
}
