<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomNotification extends Notification
{
    use Queueable;

    public $data;
    public $className;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data  = $data;
        $this->className= CustomNotification::class;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [DbNotification::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    { 
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'notification_type_id' => $this->data['notification_type_id'],
            'notification_custom_id' => $this->data['notification_custom_id'],
            'data' => [ ]
        ];
    }
}
