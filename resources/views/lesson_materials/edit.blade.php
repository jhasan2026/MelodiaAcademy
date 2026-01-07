<x-layout>
    <x-slot:heading>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                    Edit Lesson Material
                </h1>
                <p class="mt-1 text-sm text-gray-300">
                    Update details or replace the file for this material.
                </p>
            </div>

            <a href="{{ route('lesson_materials.index', $course) }}"
               class="inline-flex items-center gap-2 rounded-xl px-4 py-2
                      border border-white/10 bg-white/5 text-gray-200
                      hover:bg-white/10 transition focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                ← Back to Materials
            </a>
        </div>
    </x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course"></x-sidenavbar>

        <div class="mx-auto w-full max-w-4xl px-0 sm:px-2">
            <div class="relative overflow-hidden rounded-3xl border border-white/10
                        bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 shadow-2xl">

                <!-- Ambient glow -->
                <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-purple-600/20 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-indigo-600/20 blur-3xl"></div>

                <form
                    action="{{ route('lesson_materials.update', [$course, $lessonMaterial]) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="relative p-6 sm:p-8 text-white"
                >
                    @csrf
                    @method('PUT')

                    <!-- Top info card -->
                    <div class="mb-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-3">
                                <div class="h-12 w-12 rounded-2xl border border-white/10 bg-white/5
                                            flex items-center justify-center shadow">
                                    🛠️
                                </div>
                                <div>
                                    <div class="text-lg font-semibold text-white">Material Settings</div>
                                    <div class="text-sm text-gray-300">
                                        Edit the fields below, then save your changes.
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs text-gray-400">
                                Fields marked <span class="text-red-300">*</span> are required.
                            </div>
                        </div>
                    </div>

                    <!-- Form grid -->
                    <div class="grid gap-6 lg:grid-cols-2">

                        <!-- Course -->
                        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                            <label class="block mb-2 text-sm font-semibold text-gray-200">
                                Course <span class="text-red-300">*</span>
                            </label>

                            <select name="course_id"
                                    class="w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-3
                                           text-gray-100 outline-none transition
                                           focus:ring-2 focus:ring-indigo-500/60">
                                @foreach($courses as $courseOption)
                                    <option value="{{ $courseOption->id }}"
                                        {{ $lessonMaterial->course_id == $courseOption->id ? 'selected' : '' }}>
                                        {{ $courseOption->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('course_id')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                            <label class="block mb-2 text-sm font-semibold text-gray-200">
                                Title <span class="text-red-300">*</span>
                            </label>

                            <input type="text"
                                   name="title"
                                   value="{{ $lessonMaterial->title }}"
                                   class="w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-3
                                          text-gray-100 outline-none transition
                                          focus:ring-2 focus:ring-purple-500/60
                                          @error('title') border-red-500/40 focus:ring-red-500/30 @enderror">

                            @error('title')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="lg:col-span-2 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                            <label class="block mb-2 text-sm font-semibold text-gray-200">
                                Description
                            </label>

                            <textarea name="description"
                                      rows="5"
                                      class="w-full rounded-xl border border-white/10 bg-gray-900/60 px-4 py-3
                                             text-gray-100 outline-none transition
                                             focus:ring-2 focus:ring-indigo-500/60
                                             @error('description') border-red-500/40 focus:ring-red-500/30 @enderror">{{ $lessonMaterial->description }}</textarea>

                            <p class="mt-2 text-xs text-gray-400">
                                Keep it concise—students should understand what this file contains.
                            </p>

                            @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File -->
                        <div class="lg:col-span-2 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <label class="block mb-1 text-sm font-semibold text-gray-200">
                                        Replace File (optional)
                                    </label>
                                    <p class="text-xs text-gray-400">
                                        Upload a new file only if you want to replace the current one.
                                    </p>
                                </div>

                                <!-- Current file pill -->
                                <div class="rounded-xl border border-white/10 bg-gray-950/40 px-4 py-2 text-xs text-gray-300">
                                    <span class="text-gray-400">Current:</span>
                                    <a href="{{ Storage::url($lessonMaterial->file_path) }}"
                                       target="_blank"
                                       class="ml-1 text-indigo-300 hover:text-indigo-200 underline">
                                        View file
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4 rounded-2xl border border-dashed border-white/15 bg-white/[0.03] p-5 hover:border-white/25 transition">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-start gap-3">
                                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-200">Choose a replacement file</p>
                                            <p class="mt-1 text-xs text-gray-400">
                                                PDF, DOCX, PPTX, or ZIP (server limits apply).
                                            </p>

                                            <p id="fileMeta" class="mt-2 hidden text-xs text-gray-300">
                                                <span class="text-gray-400">Selected:</span>
                                                <span id="fileName" class="font-medium text-gray-200"></span>
                                                <span id="fileSize" class="text-gray-400"></span>
                                            </p>
                                        </div>
                                    </div>

                                    <label for="file"
                                           class="inline-flex cursor-pointer items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition
                                                  hover:bg-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500/50">
                                        Browse
                                    </label>
                                </div>

                                <input id="file" type="file" name="file" class="sr-only">
                            </div>

                            @error('file')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror

                            <p class="mt-3 text-xs text-gray-400">
                                Stored path: <span class="text-gray-300">{{ $lessonMaterial->file_path }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <a href="{{ route('lesson_materials.index', $course) }}"
                           class="inline-flex justify-center rounded-xl px-5 py-3
                                  border border-white/10 bg-white/5 text-gray-200
                                  hover:bg-white/10 transition focus:outline-none focus:ring-2 focus:ring-white/20">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl px-7 py-3
                                       bg-gradient-to-r from-yellow-400 via-amber-500 to-orange-500
                                       text-black font-semibold shadow-lg shadow-amber-500/25
                                       hover:shadow-amber-500/40 hover:scale-[1.02]
                                       transition-all focus:outline-none focus:ring-2 focus:ring-amber-300/40">
                            Save Changes ↗
                        </button>
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
                            if (!bytes && bytes !== 0) return '';
                            const units = ['B', 'KB', 'MB', 'GB'];
                            let i = 0;
                            let value = bytes;
                            while (value >= 1024 && i < units.length - 1) {
                                value = value / 1024;
                                i++;
                            }
                            return `(${value.toFixed(i === 0 ? 0 : 1)} ${units[i]})`;
                        }

                        input.addEventListener('change', function () {
                            const file = this.files && this.files[0];
                            if (!file) {
                                meta.classList.add('hidden');
                                nameEl.textContent = '';
                                sizeEl.textContent = '';
                                return;
                            }
                            nameEl.textContent = file.name;
                            sizeEl.textContent = ' ' + formatBytes(file.size);
                            meta.classList.remove('hidden');
                        });
                    })();
                </script>
            </div>
        </div>
    </x-sidenavbar-container>
</x-layout>
