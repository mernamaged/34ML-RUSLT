<?php

namespace App\Listeners;

use App\Notifications\AchievementUnlocked;
use App\Notifications\SendEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAchievementNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $achievementName = $event->achievementName;
        $user = $event->user;

        Notification::send($user, new SendEmailNotification($achievementName));
    }
}
