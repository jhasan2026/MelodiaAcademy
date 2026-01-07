{{-- Remove this if your project already loads Tailwind via Vite/Mix --}}
<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>Edit Assigned Course</x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 sm:py-16 mx-auto">
            <div class="lg:w-2/3 w-full mx-auto">
                <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="px-6 sm:px-10 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-start justify-between gap-6">
                            <div>
                                <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Edit Assignment</h2>
                                <p class="mt-1 text-sm text-gray-500">Update the course or instructor for this assignment.</p>
                            </div>
                            <span class="hidden sm:inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-600 shadow-xs">
                                Editing
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('assigned-courses.update', $assignedCourse) }}"
                          method="POST"
                          class="px-6 sm:px-10 py-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            {{-- Course --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Select Course</label>

                                <select
                                    name="course_id"
                                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200"
                                >
                                    <option value="" disabled>-- Select a course --</option>

                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course_id', $assignedCourse->course_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('course_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Instructor --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Select Instructor</label>

                                <select
                                    name="instructor_id"
                                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200"
                                >
                                    <option value="" disabled>-- Select an instructor --</option>

                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ old('instructor_id', $assignedCourse->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->user->first_name }} {{ $instructor->user->last_name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('instructor_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-10 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                            <a href="{{ route('assigned-courses.index') }}"
                               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-xs transition hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
