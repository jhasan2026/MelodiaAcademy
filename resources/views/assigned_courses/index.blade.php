<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>Assigned Courses</x-slot:heading>

    <div class="mb-4 pt-12 ml-64">
            <a href="{{ route('assigned-courses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Assign New Course</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 m-4 rounded">
            {{ session('success') }}
        </div>
    @endif


    <div class="flex justify-center  ">
        

        <table class="w-1/2 m-8 bg-white text-black rounded">
            <thead>
            <tr>
                <th class="px-4 py-2">Course</th>
                <th class="px-4 py-2">Instructor</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($assignedCourses as $assigned)
                <tr>
                    <td class="border px-4 py-2">{{ $assigned->course->name }}</td>
                    <td class="border px-4 py-2">{{ $assigned->instructor->first_name . " " . $assigned->instructor->last_name }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('assigned-courses.edit', $assigned) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('assigned-courses.destroy', $assigned) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-4">
        {{ $assignedCourses->links() }}
    </div>
</x-layout>
