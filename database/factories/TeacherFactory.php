<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        $subject = Subject::inRandomOrder()->first();

        // Create user for teacher
        $user = User::factory()->teacher()->create();

        return [
            'user_id' => $user->id,
            'name' => $user->fname . ' ' . $user->lname,
            'address' => fake()->address(),
            'subject_id' => $subject->id,
            'image' => null,
        ];
    }
}
