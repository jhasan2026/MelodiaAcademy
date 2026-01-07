<x-layout>
    <x-slot:heading>{{ $lessonMaterial->title }}</x-slot:heading>

    <div class="bg-gray-800 p-6 rounded text-white">
        <p><strong>Course:</strong> {{ $lessonMaterial->course->title }}</p>
        <p><strong>Description:</strong> {{ $lessonMaterial->description }}</p>
        <p><strong>File:</strong> <a href="{{ Storage::url($lessonMaterial->file_path) }}" target="_blank" class="text-blue-400 underline">View</a></p>
    </div>

    <a href="{{ route('lesson_materials.index') }}" class="mt-4 inline-block bg-gray-600 px-4 py-2 rounded">Back to List</a>
</x-layout>
