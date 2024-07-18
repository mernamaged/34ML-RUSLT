<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Lesson::create([
            'user_id' => 1,
        ]);

        Lesson::insert([
            [
                'user_id' => 1,
            ],
        ]);
    }
}
