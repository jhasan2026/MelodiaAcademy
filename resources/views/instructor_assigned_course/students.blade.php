<x-layout>
    <x-slot:heading>
        Students Enrolled in {{ $course->name }}
    </x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course" />

        <div class="container mx-auto py-10">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                <!-- Header -->
                <div class="px-6 py-4 border-b bg-gray-50 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Enrolled Students
                    </h2>
                    <span class="text-sm text-gray-500">
                        Total: {{ $enrollments->total() }}
                    </span>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">#</th>
                            <th class="px-6 py-3 text-left font-semibold">Student</th>
                            <th class="px-6 py-3 text-left font-semibold">Email</th>
                            <th class="px-6 py-3 text-left font-semibold">Gender</th>
                            <th class="px-6 py-3 text-left font-semibold">Enrolled</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                        @forelse($enrollments as $index => $enroll)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Index -->
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $enrollments->firstItem() + $index }}
                                </td>

                                <!-- Student -->
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <img
                                        class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-100"
                                        src="{{
                                            $enroll->student->user->profile?->profile_pic
                                                ? asset($enroll->student->user->profile->profile_pic)
                                                : asset('images/default.jpg')
                                        }}"
                                        alt="Avatar"
                                    >

                                    <div>
                                        <p class="font-medium text-gray-900">
                                            {{ $enroll->student->user->first_name }}
                                            {{ $enroll->student->user->last_name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Student ID #{{ $enroll->student->id }}
                                        </p>
                                    </div>
                                </td>

                                <!-- Email -->
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $enroll->student->user->email }}
                                </td>

                                <!-- Gender Badge -->
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        {{ $enroll->student->gender === 'male'
                                            ? 'bg-blue-100 text-blue-700'
                                            : 'bg-pink-100 text-pink-700' }}">
                                        {{ ucfirst($enroll->student->gender) }}
                                    </span>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $enroll->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-400 text-sm">
                                        No students enrolled yet 📭
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t bg-gray-50">
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </x-sidenavbar-container>
</x-layout>
