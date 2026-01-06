<x-layout>
    <x-slot:heading>Edit Assigned Course</x-slot:heading>

    <form action="{{ route('assigned-courses.update', $assignedCourse) }}" method="POST" class="bg-white p-6 rounded shadow-md text-black">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Select Course</label>
            <select name="course_id" class="border p-2 w-full">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $assignedCourse->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Select Instructor</label>
            <select name="instructor_id" class="border p-2 w-full">
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ $assignedCourse->instructor_id == $instructor->id ? 'selected' : '' }}>
                        {{ $instructor->first_name . " " . $instructor->last_name }}
                    </option>
                @endforeach
            </select>
            @error('instructor_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</x-layout>
