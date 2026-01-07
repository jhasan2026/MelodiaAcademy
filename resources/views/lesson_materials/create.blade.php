<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Upload lesson material</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Add a title, a short description, and attach your file.
                </p>
            </div>

            <a href="{{ route('courses.show', $course) }}"
               class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to course
            </a>
        </div>
    </x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course"></x-sidenavbar>

        <div class="mx-auto w-full max-w-3xl space-y-6">
            <!-- Header card -->
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="rounded-xl border border-gray-200 bg-gray-100 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Material details</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Upload PDFs, slides, or documents so students can access them in the course.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form
                action="{{ route('lesson_materials.store', $course) }}"
                method="POST"
                enctype="multipart/form-data"
                class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
            >
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-700">
                        <div class="font-semibold">Please fix the following:</div>
                        <ul class="mt-2 list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="mb-2 block text-sm font-medium text-gray-700">
                            Title <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="e.g., Week 3 — Calculus Notes"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder:text-gray-400 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >

                        <p class="mt-2 text-xs text-gray-500">Keep it short and searchable.</p>

                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="mb-2 block text-sm font-medium text-gray-700">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Add a brief description (optional)…"
                            class="w-full resize-y rounded-lg border border-gray-300 px-4 py-3 text-gray-900 placeholder:text-gray-400 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >{{ old('description') }}</textarea>

                        <p class="mt-2 text-xs text-gray-500">
                            Tip: Include what’s covered and any prerequisites.
                        </p>

                        @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File -->
                    <div>
                        <label for="file" class="mb-2 block text-sm font-medium text-gray-700">
                            File <span class="text-red-500">*</span>
                        </label>

                        <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-5">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Choose a file to upload</p>
                                    <p class="mt-1 text-xs text-gray-500">
                                        PDF, DOCX, PPTX, or ZIP. Max size depends on server config.
                                    </p>

                                    <p id="fileMeta" class="mt-2 hidden text-xs text-gray-600">
                                        <span class="text-gray-500">Selected:</span>
                                        <span id="fileName" class="font-medium text-gray-800"></span>
                                        <span id="fileSize" class="text-gray-500"></span>
                                    </p>
                                </div>

                                <label
                                    for="file"
                                    class="inline-flex cursor-pointer items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    Browse
                                </label>
                            </div>

                            <input
                                id="file"
                                type="file"
                                name="file"
                                class="sr-only"
                            >
                        </div>

                        @error('file')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
                        <a
                            href="{{ route('courses.show', $course) }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Upload material
                        </button>
                    </div>
                </div>
            </form>

            <script>
                (function () {
                    const input = document.getElementById('file');
                    const meta = document.getElementById('fileMeta');
                    const nameEl = document.getElementById('fileName');
                    const sizeEl = document.getElementById('fileSize');

                    if (!input) return;

                    function formatBytes(bytes) {
                        const units = ['B', 'KB', 'MB', 'GB'];
                        let i = 0;
                        let value = bytes;
                        while (value >= 1024 && i < units.length - 1) {
                            value /= 1024;
                            i++;
                        }
                        return `(${value.toFixed(i === 0 ? 0 : 1)} ${units[i]})`;
                    }

                    input.addEventListener('change', function () {
                        const file = this.files && this.files[0];
                        if (!file) {
                            meta.classList.add('hidden');
                            return;
                        }
                        nameEl.textContent = file.name;
                        sizeEl.textContent = ' ' + formatBytes(file.size);
                        meta.classList.remove('hidden');
                    });
                })();
            </script>
        </div>
    </x-sidenavbar-container>
</x-layout>
