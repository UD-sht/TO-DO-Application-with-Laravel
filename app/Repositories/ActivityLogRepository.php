<?php

namespace App\Repositories;

use DB;
use App\Models\ActivityLog;

class ActivityLogRepository extends BaseRepository
{
    public function __construct(
        ActivityLog $activityLog
    )
    {
        $this->model = $activityLog;
    }
}
