<x-layout>
    <x-slot:heading>Assign Course</x-slot:heading>

    <form action="{{ route('assigned-courses.store') }}" method="POST" class="bg-white p-6 rounded shadow-md text-black">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Select Course</label>
            <select name="course_id" class="border p-2 w-full">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Select Instructor</label>
            <select name="instructor_id" class="border p-2 w-full">
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->first_name . " " . $instructor->last_name }}</option>
                @endforeach
            </select>
            @error('instructor_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Assign</button>
    </form>
</x-layout>
