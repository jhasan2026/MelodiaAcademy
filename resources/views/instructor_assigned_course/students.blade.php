<x-layout>
    <x-slot:heading>
        Students Enrolled in {{ $course->name }}
    </x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course"></x-sidenavbar>

        <div class="container mx-auto py-10">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold"></th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Student Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Gender</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Enrolled At</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($enrollments as $index => $enroll)
                        <tr class="hover:bg-gray-50">
                            <!-- Serial Number -->
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $enrollments->firstItem() + $index }}
                            </td>

                            <!-- Student Name -->
                            <td class="px-6 py-2 text-sm font-medium text-gray-900">
                                <img
                                    class="w-10 h-10  object-cover"
                                    src="{{
                                        $enroll->student->user->profile && $enroll->student->user->profile->profile_pic
                                            ? asset($enroll->student->user->profile->profile_pic)
                                            : asset('images/default.jpg')
                                    }}"
                                    alt="Student Avatar"
                                    >
                            </td>


                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $enroll->student->user->first_name }}
                                {{ $enroll->student->user->last_name }}
                            </td>

                            <!-- Email -->
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $enroll->student->user->email }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ ucfirst( $enroll->student->gender) }}
                            </td>

                            <!-- Enrolled Date -->
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $enroll->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                No students enrolled in this course.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $enrollments->links() }}
            </div>
        </div>


        </div>
    </x-sidenavbar-container>
</x-layout>
