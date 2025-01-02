<?php

namespace Modules\TaskSchedule\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TaskSchedule extends Model
{
    protected $table = 'task_schedule';
    protected $primaryKey = 'id';
    protected $fillable = [
        'task_name',
        'description',
        'priority',
        'status',
        'due_date',
        'user_code',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}