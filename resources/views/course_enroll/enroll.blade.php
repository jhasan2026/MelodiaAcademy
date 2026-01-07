<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Student Enrolment
    </x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 sm:py-14 mx-auto">
            <div class="lg:w-11/12 w-full mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Student Enrolment</h2>
                        <p class="mt-1 text-sm text-gray-500">Review enrolment requests and approve or reject pending entries.</p>
                    </div>
                    <span class="hidden sm:inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-600 shadow-xs">
                        {{ $course_enrolments->count() }} shown
                    </span>
                </div>

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white px-5 sm:px-6 py-4">
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-sm font-semibold text-gray-900">Enrolment List</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="bg-white">
                            <tr class="border-b border-gray-100">
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Course Name
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Student Id
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Student Name
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Date
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Amount
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Payment Method
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Status
                                </th>
                                <th scope="col" class="px-5 sm:px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Action
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($course_enrolments as $course_enrolment)
                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-5 sm:px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-9 w-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                <span class="text-xs font-semibold text-gray-700">
                                                    {{ strtoupper(mb_substr($course_enrolment->course->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-semibold text-gray-900">
                                                    {{ $course_enrolment->course->name }}
                                                </p>
                                                <p class="text-xs text-gray-500">Course</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $course_enrolment->student_id }}
                                        </span>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">
                                            {{ $course_enrolment->student->user->first_name . " " . $course_enrolment->student->user->last_name }}
                                        </span>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <span class="text-sm text-gray-700">
                                            {{ $course_enrolment->created_at->toDateString() }}
                                        </span>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <span class="text-sm font-semibold text-gray-900">
                                            {{ $course_enrolment->course->payment }}
                                        </span>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <span class="text-sm text-gray-700">231</span>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <span class="
                                            inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border
                                            @if($course_enrolment->enroll_status === 'pending')
                                                bg-yellow-50 text-yellow-800 border-yellow-200
                                            @elseif($course_enrolment->enroll_status === 'approved')
                                                bg-green-50 text-green-800 border-green-200
                                            @elseif($course_enrolment->enroll_status === 'rejected')
                                                bg-red-50 text-red-800 border-red-200
                                            @else
                                                bg-gray-50 text-gray-800 border-gray-200
                                            @endif
                                        ">
                                            <span class="
                                                h-1.5 w-1.5 rounded-full
                                                @if($course_enrolment->enroll_status === 'pending')
                                                    bg-yellow-500
                                                @elseif($course_enrolment->enroll_status === 'approved')
                                                    bg-green-500
                                                @elseif($course_enrolment->enroll_status === 'rejected')
                                                    bg-red-500
                                                @else
                                                    bg-gray-400
                                                @endif
                                            "></span>
                                            {{ ucfirst($course_enrolment->enroll_status) }}
                                        </span>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        @if($course_enrolment->enroll_status === 'pending')
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('course-enroll.approve', $course_enrolment->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="inline-flex items-center justify-center rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white shadow-xs transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-200">
                                                        Approve
                                                    </button>
                                                </form>

                                                <form action="{{ route('course-enroll.reject', $course_enrolment->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-xs font-semibold text-white shadow-xs transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-200">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="flex justify-end">
                                                <span class="text-gray-400 text-sm">—</span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
