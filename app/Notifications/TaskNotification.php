<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\TaskSchedule\Models\TaskSchedule;
use Illuminate\Notifications\Messages\MailMessage;

class TaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;
    protected $type;  

    public function __construct(TaskSchedule $task, string $type)
    {
        $this->task = $task;
        $this->type = $type;
    }

    public function via(User $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->success()
            ->subject($this->getSubject())
            ->line($this->getSubject())
            ->action('View Task', route('todo.index', $this->task->id))
            ->line('Thank you!');

        return $mailMessage;
    }

    public function toArray(User $notifiable): array
    {
        return [
            'link' => route('todo.index'),
            'task_id' => $this->task->id,
            'title' => $this->task->title,
            'status' => $this->task->status,
            'due_date' => Carbon::parse($this->task->due_date)->toDateString(),
            'type' => $this->type,
            'subject' => $this->getSubject(),
        ];
    }

    protected function getSubject()
    {
        switch ($this->type) {
            case 'created':
                return 'New Task Created: ' . $this->task->title;
            case 'updated':
                return 'Task Updated: ' . $this->task->title;
            case 'completed':
                return 'Task Completed: ' . $this->task->title;
            case 'overdue':
                return 'Task Overdue: ' . $this->task->title;
            case 'deadline':
                return 'Task Deadline Approaching: ' . $this->task->title;
            default:
                return 'Task Notification: ' . $this->task->title;
        }
    }
}
