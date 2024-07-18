<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\lesson;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class AchievementController extends Controller
{
    use Notifiable;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $user)
    {
        $user = User::findorFail($user);
        $no_lesson_Watched = lesson::count();
        $no_comment_Watched = comment::count();

        $unlocked_achievements = [];
        $next_available_achievements = [];

        // Define all possible achievements in order of unlock
        $achievements = [
            50 => '50 Lessons Watched',
            25 => '25 Lessons Watched',
            10 => '10 Lessons Watched',
            5 => '5 Lessons Watched',
            1 => 'First Lesson Watched',

        ];

        $Comments = [
            20 => '20 Comments Written ',
            10 => '10 Comments Written ',
            5 => '5 Comments Written ',
            3 => '3 Comments Written ',
            1 => 'First Comment Written ',
        ];

        // Iterate through achievements to determine unlocked and next available achievements
        foreach ($achievements as $lesson_count => $achievement_name) {
            if ($no_lesson_Watched >= $lesson_count) {
                $unlocked_achievements[] = $achievement_name;
            } else {
                $next = $achievement_name;
            }
        }
        foreach ($Comments as $comment_count => $comment_name) {
            if ($no_comment_Watched >= $comment_count) {
                $unlocked_achievements[] = $comment_name;
            } else {
                $next_available_achievements = [$comment_name, $next];
            }
        }
        //sum of the number of lessons with th number of columns of comments
        $achievementsUnlocked = $no_comment_Watched + $no_lesson_Watched;

        $badges = [
            ['name' => 'Beginner', 'threshold' => 0],
            ['name' => 'Intermediate', 'threshold' => 4],
            ['name' => 'Advanced', 'threshold' => 8],
            ['name' => 'Master', 'threshold' => 10],
        ];

        // Initialize variables to store badge information
        $current_badge = '';
        $next_badge = '';
        $remaining_to_unlock_next_badge = 0;

        // Determine current badge
        foreach ($badges as $badge) {
            if ($achievementsUnlocked >= $badge['threshold']) {
                $current_badge = $badge['name'];
            } else {
                break; // Stop checking further once current badge is found
            }
        }

        // Determine next badge and remaining achievements needed
        foreach ($badges as $badge) {
            if ($achievementsUnlocked < $badge['threshold']) {
                $next_badge = $badge['name'];
                $remaining_to_unlock_next_badge = $badge['threshold'] - $achievementsUnlocked;
                break; // Stop once next badge is found
            }
        }

        return response([
            'unlockedAchievements' => $unlocked_achievements,
            'next_available_achievements' => $next_available_achievements,
            'current_badge' => $current_badge,
            'next_badge' => $next_badge,
            'remaining_to_unlock_next_badge' => $remaining_to_unlock_next_badge,
        ], 200);
    }
}
