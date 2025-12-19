<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CourseTopic;
use App\Models\Course;

class CourseTopicFactory extends Factory
{
    protected $model = CourseTopic::class;

    public function definition(): array
    {
        return [
            'topic' => $this->faker->sentence(3),
            // 'course_id' will be assigned in the seeder
        ];
    }
}
