<?php

namespace Database\Seeders;

use App\Models\comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        comment::create([
            'user_id' => 1,
        ]);
        Comment::insert([
            [
                'user_id' => 1,

            ],
            [
                'user_id' => 1,
            ],
        ]);
    }
}
