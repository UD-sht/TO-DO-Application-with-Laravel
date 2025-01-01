<?php

namespace App\Repositories;

use DB;
use App\Models\AuditLog;

class AuditLogRepository extends BaseRepository
{
    public function __construct(
        AuditLog $auditLogs
    )
    {
        $this->model = $auditLogs;
    }
}
