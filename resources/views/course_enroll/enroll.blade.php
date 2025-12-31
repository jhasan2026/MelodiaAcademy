<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Student Enrolment
    </x-slot:heading>


    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base  pt-8">
        <table class="w-full text-sm text-left rtl:text-right text-body bg-white ">
            <thead class="text-lg text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium">
                    Course Name
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Student Id
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Student Name
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Date
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Payment Method
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($course_enrolments as $course_enrolment)
                <tr class="bg-neutral-primary border-b border-default">
                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        {{ $course_enrolment->course->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $course_enrolment->student_id }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $course_enrolment->student->user->first_name . " " . $course_enrolment->student->user->last_name  }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $course_enrolment->created_at->toDateString() }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $course_enrolment->course->payment }}
                    </td>
                    <td class="px-6 py-4">
                        231
                    </td>
                    <td class="px-6 py-4">
                        <span class="
                            inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                            @if($course_enrolment->enroll_status === 'pending')
                                bg-yellow-100 text-yellow-800
                            @elseif($course_enrolment->enroll_status === 'approved')
                                bg-green-100 text-green-800
                            @elseif($course_enrolment->enroll_status === 'rejected')
                                bg-red-100 text-red-800
                            @else
                                bg-gray-100 text-gray-800
                            @endif
                        ">
                            {{ ucfirst($course_enrolment->enroll_status) }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        @if($course_enrolment->enroll_status === 'pending')
                            <div class="flex gap-2">
                                <!-- Approve -->
                                <form action="{{ route('course-enroll.approve', $course_enrolment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-4 py-1.5 text-sm font-semibold text-white
                           bg-green-600 rounded-lg hover:bg-green-700 transition">
                                        Approve
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form action="{{ route('course-enroll.reject', $course_enrolment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-4 py-1.5 text-sm font-semibold text-white
                           bg-red-600 rounded-lg hover:bg-red-700 transition">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-gray-400 text-sm">—</span>
                        @endif
                    </td>


                </tr>
            @endforeach


            </tbody>
        </table>
    </div>

</x-layout>
