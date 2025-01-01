<?php

namespace App\Http\Middleware;

use App\Repositories\ActivityLogRepository;
use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;
use Illuminate\Support\Facades\Auth;

class ActivityLogger extends TransformsRequest
{
    protected $activityLogs;
    public function __construct(
        ActivityLogRepository $activityLogs
    ) {
        $this->activityLogs = $activityLogs;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $inputs = $request->all();
        array_walk_recursive($inputs, function (&$input) {
            $input = str_replace("'", '', strip_tags($input));
        });
        $request->merge($inputs);

        if (! $request->has('draw')) {
            $authUser = Auth::user();
            $inputs = [
                'user_code' => $authUser ? $authUser->user_code : null,
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'method' => $request->getMethod(),
                'route' => $request->fullUrl(),
                'agent' => $request->server('HTTP_USER_AGENT'),
                'payload' => json_encode($request->all()),
            ];
            $this->activityLogs->create($inputs);
        }

        return parent::handle($request, $next);
    }

    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        return $value === '' ? null : $value;
    }
}
