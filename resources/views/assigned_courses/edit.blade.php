{{-- Remove if you already load Tailwind --}}
<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>Edit Assigned Course</x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 sm:py-16 mx-auto">
            <div class="lg:w-2/3 w-full mx-auto">
                <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="px-6 sm:px-10 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div>
                            <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Edit Assignment</h2>
                            <p class="mt-1 text-sm text-gray-500">Update course, instructor, and timetable.</p>
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
                                <select name="course_id"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course_id', $assignedCourse->course_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Instructor --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Select Instructor</label>
                                <select name="instructor_id"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ old('instructor_id', $assignedCourse->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->user->first_name }} {{ $instructor->user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Timetable --}}
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <h3 class="text-sm font-semibold text-gray-900">Timetable</h3>

                                @php
                                    $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                                    $oldDay = old('day_of_week', $schedule?->day_of_week ?? 1);
                                    $oldStart = old('start_time', $schedule?->start_time ? substr($schedule->start_time,0,5) : '10:00');
                                    $oldEnd = old('end_time', $schedule?->end_time ? substr($schedule->end_time,0,5) : '11:00');
                                    $oldNote = old('note', $schedule?->note ?? '');
                                @endphp

                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Day</label>
                                        <select name="day_of_week"
                                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900">
                                            @foreach($days as $i => $d)
                                                <option value="{{ $i }}" {{ (string)$oldDay === (string)$i ? 'selected' : '' }}>
                                                    {{ $d }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('day_of_week') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Start Time</label>
                                        <input type="time" name="start_time" value="{{ $oldStart }}"
                                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900">
                                        @error('start_time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">End Time</label>
                                        <input type="time" name="end_time" value="{{ $oldEnd }}"
                                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900">
                                        @error('end_time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-semibold text-gray-900 mb-2">Note (optional)</label>
                                    <input type="text" name="note" value="{{ $oldNote }}"
                                           class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900">
                                    @error('note') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                            <a href="{{ route('assigned-courses.index') }}"
                               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-800">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</x-layout>
