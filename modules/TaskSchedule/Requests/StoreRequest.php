<?php

namespace Modules\TaskSchedule\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed,overdue',
            'due_date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [];
    }

}
