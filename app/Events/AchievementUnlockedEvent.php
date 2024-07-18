<?php

namespace App\Http\Controllers;

use App\Events\AchievementUnlockedEvent;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function unlockAchievement(Request $request)
    {
        $userId = $request->input('user_id');
        $achievementName = $request->input('achievement_name');

        $user = User::findOrFail($userId);

        $user->achievements()->create([
            'name' => $achievementName,
        ]);

        event(new AchievementController($user, $achievementName));

        return response()->json(['message' => 'Achievement unlocked successfully']);
    }
}
