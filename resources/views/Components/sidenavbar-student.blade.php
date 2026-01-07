<x-sidenavbar-inner>
    @php
        $courseId = request()->route('course');
        $courseId = is_object($courseId) ? $courseId->id : $courseId;
    @endphp

    <x-nav-link href="{{ route('course-enroll.index') }}">
        Courses
    </x-nav-link>

    @if($courseId)
{{--        <x-nav-link--}}
{{--            href="{{ route('instructor.courses.students', $courseId) }}"--}}
{{--            :active="request()->is('instructor_assigned_courses/*/students')">--}}
{{--            Course Students--}}
{{--        </x-nav-link>--}}

{{--        --}}
    @endif
</x-sidenavbar-inner>
