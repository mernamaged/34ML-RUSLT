<?php
// app/Notifications/SendEmailNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendEmailNotification extends Notification
{
    use Queueable;

    public $achievementName;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail']; 
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Congratulations!')
                    ->line('You have unlocked a new achievement: ' . $this->achievementName);
    }
}
