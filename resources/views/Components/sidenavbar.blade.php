<x-sidenavbar-inner>
    @php
        $courseId = request()->route('course');
        $courseId = is_object($courseId) ? $courseId->id : $courseId;
    @endphp

    <x-nav-link href="{{ route('instructor_assigned_courses.index') }}">
        Courses
    </x-nav-link>

    @if($courseId)
        <x-nav-link
            href="{{ route('instructor.courses.students', $courseId) }}"
            :active="request()->is('instructor_assigned_courses/*/students')">
            Course Students
        </x-nav-link>

        <x-nav-link
            href="{{ route('lesson_materials.index', $courseId) }}"
            :active="request()->is('instructor_assigned_courses/*/lesson_materials*')">
            Lesson Materials
        </x-nav-link>

        <x-nav-link
            href="{{ route('instructor.attendance.index', $courseId) }}"
            :active="request()->is('instructor_assigned_courses/*/attendents')">
            Attendance
        </x-nav-link>
    @endif
</x-sidenavbar-inner>
