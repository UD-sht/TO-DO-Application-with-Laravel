<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    public $table = 'transaction_logs';

    protected $fillable = [
        'user_code',
        'model_id',
        'model',
        'action',
        'description',
        'before_details',
        'after_details',
        'ip_address',
    ];
}
