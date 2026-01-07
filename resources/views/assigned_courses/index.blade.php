<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>Assigned Courses</x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 sm:py-14 mx-auto">
            <div class="lg:w-5/6 w-full mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Assigned Courses</h2>
                        <p class="mt-1 text-sm text-gray-500">Manage course assignments and update instructors.</p>
                    </div>

                    <a href="{{ route('assigned-courses.create') }}"
                       class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Assign New Course
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-xs">
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 h-2.5 w-2.5 rounded-full bg-green-500"></div>
                            <div class="min-w-0">
                                <p class="font-semibold text-green-900">Success</p>
                                <p class="text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white px-5 sm:px-6 py-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-900">All Assignments</p>
                            <span class="hidden sm:inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-600 shadow-xs">
                                {{ $assignedCourses->total() }} total
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-white">
                            <tr>
                                <th class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Course
                                </th>
                                <th class="px-5 sm:px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Instructor
                                </th>
                                <th class="px-5 sm:px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    Actions
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($assignedCourses as $assigned)
                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-5 sm:px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-9 w-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                <span class="text-xs font-semibold text-gray-700">
                                                    {{ strtoupper(mb_substr($assigned->course->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-semibold text-gray-900">
                                                    {{ $assigned->course->name }}
                                                </p>
                                                <p class="text-xs text-gray-500">Course</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-9 w-9 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                <span class="text-xs font-semibold text-gray-700">
                                                    {{ strtoupper(mb_substr($assigned->instructor->first_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="truncate text-sm font-semibold text-gray-900">
                                                    {{ $assigned->instructor->first_name . " " . $assigned->instructor->last_name }}
                                                </p>
                                                <p class="text-xs text-gray-500">Instructor</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-5 sm:px-6 py-4">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('assigned-courses.edit', $assigned) }}"
                                               class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-semibold text-gray-700 shadow-xs transition hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                                Edit
                                            </a>

                                            <form action="{{ route('assigned-courses.destroy', $assigned) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 shadow-xs transition hover:bg-red-100 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-red-200"
                                                        onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 sm:px-6 py-10 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div class="mx-auto h-12 w-12 rounded-2xl bg-gray-100 border border-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500 text-lg">—</span>
                                            </div>
                                            <p class="mt-3 text-sm font-semibold text-gray-900">No assignments found</p>
                                            <p class="mt-1 text-sm text-gray-500">Assign a course to an instructor to see it listed here.</p>
                                            <div class="mt-5">
                                                <a href="{{ route('assigned-courses.create') }}"
                                                   class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                                    Assign New Course
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-gray-100 bg-white px-5 sm:px-6 py-4">
                        {{ $assignedCourses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
