{{-- Remove if you already load Tailwind --}}
<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>Assign Course</x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 sm:py-16 mx-auto">
            <div class="lg:w-2/3 w-full mx-auto">
                <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="px-6 sm:px-10 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-start justify-between gap-6">
                            <div>
                                <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Assign Course</h2>
                                <p class="mt-1 text-sm text-gray-500">Choose course, instructor, and set timetable.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('assigned-courses.store') }}" method="POST" class="px-6 sm:px-10 py-8">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">

                            {{-- Course --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Select Course</label>
                                <select name="course_id"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    <option value="" disabled {{ old('course_id') ? '' : 'selected' }}>-- Select a course --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
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
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    <option value="" disabled {{ old('instructor_id') ? '' : 'selected' }}>-- Select an instructor --</option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->user->first_name }} {{ $instructor->user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            {{-- Timetable --}}
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                                <h3 class="text-sm font-semibold text-gray-900">Timetable</h3>
                                <p class="text-xs text-gray-500 mt-1">This will be used for both student & instructor weekly schedule.</p>

                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    {{-- Day --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Day</label>
                                        <select name="day_of_week"
                                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                            @php
                                                $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                                            @endphp
                                            @foreach($days as $i => $d)
                                                <option value="{{ $i }}" {{ (string)old('day_of_week','1') === (string)$i ? 'selected' : '' }}>
                                                    {{ $d }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('day_of_week') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Start --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Start Time</label>
                                        <input type="time" name="start_time" value="{{ old('start_time','10:00') }}"
                                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                        @error('start_time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- End --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">End Time</label>
                                        <input type="time" name="end_time" value="{{ old('end_time','11:00') }}"
                                               class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                        @error('end_time') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-semibold text-gray-900 mb-2">Note (optional)</label>
                                    <input type="text" name="note" value="{{ old('note') }}"
                                           placeholder="e.g. Bring instrument / Online class"
                                           class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                    @error('note') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mt-10 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                            <a href="{{ route('assigned-courses.index') }}"
                               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-xs transition hover:bg-gray-50">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800">
                                Assign
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</x-layout>
