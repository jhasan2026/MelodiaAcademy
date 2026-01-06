<x-sidenavbar-inner>
    <x-nav-link
        href="{{ route('instructor_assigned_courses.index') }}">
        Courses
    </x-nav-link>

    <x-nav-link
        href="{{ route('instructor.courses.students', $course->id) }}"
        :active="request()->is('instructor_assigned_courses/*/students')">
        Students
    </x-nav-link>
</x-sidenavbar-inner>
