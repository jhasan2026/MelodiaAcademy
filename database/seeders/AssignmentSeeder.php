<?php

namespace Database\Seeders;

use App\Models\LessonMaterial;
use App\Models\Assignment;
use App\Models\AssignmentQuestion;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        // pick any instructor/admin as created_by (fallback to first user)
        $teacherId = User::query()->value('id') ?? 1;

        LessonMaterial::query()->get()->each(function ($material) use ($teacherId) {

            // if you re-run seeding, avoid duplicates
            if (Assignment::where('lesson_id', $material->id)->exists()) {
                return;
            }

            $count = rand(2, 5);

            $assignments = Assignment::factory()
                ->count($count)
                ->create([
                    'lesson_id' => $material->id,
                    'created_by' => $teacherId,
                ]);

            foreach ($assignments as $a) {
                if ($a->type === 'quiz') {
                    AssignmentQuestion::factory()
                        ->count(rand(3, 8))
                        ->create(['assignment_id' => $a->id]);
                }
            }
        });
    }
}
