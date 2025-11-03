<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $class = StudentClass::inRandomOrder()->first();
        $section = StudentSection::inRandomOrder()->first();

        // Create user for student
        $user = User::factory()->student()->create();

        return [
            'user_id' => $user->id,
            'name' => $user->fname . ' ' . $user->lname,
            'address' => fake()->address(),
            'dob' => Carbon::parse(fake()->date()),
            'class_id' => $class->id,
            'section_id' => $section->id,
            'image' => null,
        ];
    }
}
