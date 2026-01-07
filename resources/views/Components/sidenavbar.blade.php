<x-sidenavbar-inner>
    <x-nav-link
        href="{{ route('instructor_assigned_courses.index') }}">
        Courses
    </x-nav-link>

    <x-nav-link
        href="{{ route('instructor.courses.students', $course->id) }}"
        :active="request()->is('instructor_assigned_courses/*/students')">
        Course Students
    </x-nav-link>

    <x-nav-link
        href="{{ route('lesson_materials.index', $course->id) }}"
        :active="request()->is('instructor_assigned_courses/*/lesson_materials') || request()->is('instructor_assigned_courses/*/lesson_materials/*')">
        Lesson Materials
    </x-nav-link>

</x-sidenavbar-inner>
