<x-sidenavbar-inner>
    @php
        $courseId = request()->route('course');
        $courseId = is_object($courseId) ? $courseId->id : $courseId;
    @endphp

    <x-nav-link href="{{ route('course-enroll.index') }}">
        Courses
    </x-nav-link>

    @if($courseId)
        <x-nav-link
            href="{{ route('student.attendance.show', $courseId) }}">
            Course Attendances
        </x-nav-link>


    @endif
</x-sidenavbar-inner>
