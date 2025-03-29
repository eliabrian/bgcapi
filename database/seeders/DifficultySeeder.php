<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $difficulties = [
            'Kids',
            'Easy',
            'Medium',
            'Hard',
            'Expert',
        ];

        foreach ($difficulties as $difficulty) {
            Difficulty::create([
                'name' => $difficulty,
                'slug' => Str::slug($difficulty),
            ]);
        }
    }
}
