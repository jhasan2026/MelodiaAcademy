<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\LessonMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonMaterialController extends Controller{
    public function index(Course $course)
    {
        $materials = LessonMaterial::query()
            ->where('course_id', $course->id)
            ->latest()
            ->paginate(12);

        return view('lesson_materials.index', compact('course', 'materials'));
    }

    public function create(Course $course)
    {
        // if you want allow choosing a course in create page
        $courses = Course::query()->orderBy('title')->get();

        return view('lesson_materials.create', compact('course', 'courses'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'file' => ['required', 'file', 'max:20480'],
        ]);

        $path = $request->file('file')->store('lesson_materials', 'public');

        LessonMaterial::create([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
        ]);

        return redirect()
            ->route('lesson_materials.index', $course)
            ->with('success', 'Material uploaded successfully.');
    }

    public function edit(Course $course, LessonMaterial $lessonMaterial)
    {
        $this->ensureCourseMaterial($course, $lessonMaterial);

        // ✅ THIS FIXES your error (we now pass $courses)
        $courses = Course::query()->orderBy('title')->get();

        return view('lesson_materials.edit', compact('course', 'lessonMaterial', 'courses'));
    }

    public function update(Request $request, Course $course, LessonMaterial $lessonMaterial)
    {
        $this->ensureCourseMaterial($course, $lessonMaterial);

        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'max:20480'],
        ]);

        $lessonMaterial->course_id = $validated['course_id'];
        $lessonMaterial->title = $validated['title'];
        $lessonMaterial->description = $validated['description'] ?? null;

        if ($request->hasFile('file')) {
            if ($lessonMaterial->file_path && Storage::disk('public')->exists($lessonMaterial->file_path)) {
                Storage::disk('public')->delete($lessonMaterial->file_path);
            }

            $lessonMaterial->file_path = $request->file('file')->store('lesson_materials', 'public');
        }

        $lessonMaterial->save();

        return redirect()
            ->route('lesson_materials.index', $course)
            ->with('success', 'Material updated successfully.');
    }

    public function destroy(Course $course, LessonMaterial $lessonMaterial)
    {
        $this->ensureCourseMaterial($course, $lessonMaterial);

        if ($lessonMaterial->file_path && Storage::disk('public')->exists($lessonMaterial->file_path)) {
            Storage::disk('public')->delete($lessonMaterial->file_path);
        }

        $lessonMaterial->delete();

        return redirect()
            ->route('lesson_materials.index', $course)
            ->with('success', 'Material deleted successfully.');
    }

    private function ensureCourseMaterial(Course $course, LessonMaterial $lessonMaterial): void
    {
        abort_unless($lessonMaterial->course_id === $course->id, 404);
    }
}
