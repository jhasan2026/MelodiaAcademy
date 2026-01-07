<x-layout>
    <x-slot:heading>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Lesson Materials</h1>
                <p class="mt-1 text-sm text-gray-300">
                    Manage downloadable resources for <span class="font-semibold text-gray-100">{{ $course->title }}</span>
                </p>
            </div>

            <a href="{{ route('lesson_materials.create', $course) }}"
               class="group inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3
                      bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                      text-white font-semibold shadow-lg shadow-purple-500/25
                      hover:shadow-purple-500/45 hover:scale-[1.02]
                      transition-all duration-300">
                <span class="relative">
                    Upload New Material
                    <span class="absolute -inset-2 rounded-xl bg-white/10 opacity-0 group-hover:opacity-100 transition"></span>
                </span>
                <span class="opacity-80 group-hover:opacity-100 transition">↗</span>
            </a>
        </div>
    </x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course"></x-sidenavbar>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-400/25 bg-emerald-500/10 backdrop-blur
                    px-5 py-4 text-emerald-200 shadow-lg">
            <div class="flex items-start gap-3">
                <div class="mt-0.5 h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_20px_rgba(52,211,153,0.55)]"></div>
                <div class="font-medium">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <!-- Page container -->
    <div class="relative  overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 shadow-2xl mt-12 ml-36">
        <!-- Ambient glows -->
        <div class="pointer-events-none absolute -top-28 -right-24 h-72 w-72 rounded-full bg-fuchsia-600/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -left-24 h-72 w-72 rounded-full bg-indigo-600/20 blur-3xl"></div>

        <!-- Header row -->
        <div class="relative flex flex-col gap-4 border-b border-white/10 p-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center shadow">
                    <span class="text-xl">📚</span>
                </div>
                <div>
                    <div class="text-white font-semibold tracking-tight">Materials Library</div>
                    <div class="text-sm text-gray-300">
                        @if(method_exists($materials, 'total'))
                            {{ $materials->total() }} total item(s)
                        @else
                            Browse materials
                        @endif
                    </div>
                </div>
            </div>

            <!-- Optional search UI (non-functional, safe for production UI) -->
            <div class="w-full sm:w-[420px]">
                <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 backdrop-blur">
                    <span class="text-gray-400">🔎</span>
                    <input
                        type="text"
                        placeholder="Search title... (UI only)"
                        class="w-full bg-transparent text-sm text-gray-100 placeholder:text-gray-500 focus:outline-none"
                    />
                </div>
                <p class="mt-2 text-xs text-gray-400">
                    Tip: add server-side search later without changing this layout.
                </p>
            </div>
        </div>

        <!-- Content -->
        <div class="relative p-6">
            @if($materials->count())
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($materials as $material)
                        <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur shadow-lg">
                            <!-- Card glow on hover -->
                            <div class="pointer-events-none absolute -top-16 -right-16 h-40 w-40 rounded-full bg-purple-500/0 blur-2xl group-hover:bg-purple-500/15 transition"></div>

                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <h3 class="truncate text-lg font-semibold text-white">
                                            {{ $material->title }}
                                        </h3>

                                        <div class="mt-2 flex flex-wrap items-center gap-2">
                                            <span class="inline-flex items-center rounded-full border border-indigo-400/25 bg-indigo-500/10 px-3 py-1 text-xs font-medium text-indigo-200">
                                                {{ $material->course->title }}
                                            </span>

                                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                                                Material
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-gray-200">
                                        📄
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ Storage::url($material->file_path) }}"
                                       target="_blank"
                                       class="inline-flex w-full items-center justify-center gap-2 rounded-xl px-4 py-2.5
                                              bg-gradient-to-r from-blue-500/90 to-indigo-600/90
                                              text-white font-semibold shadow-md shadow-indigo-500/20
                                              hover:shadow-indigo-500/35 hover:scale-[1.01]
                                              transition-all">
                                        View / Download
                                        <span class="opacity-80 group-hover:opacity-100 transition">↗</span>
                                    </a>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <a href="{{ route('lesson_materials.edit',  [$course, $material]) }}"
                                       class="inline-flex flex-1 items-center justify-center rounded-xl px-4 py-2
                                              border border-yellow-400/25 bg-yellow-500/10 text-yellow-200
                                              hover:bg-yellow-500/20 hover:scale-[1.01]
                                              transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('lesson_materials.destroy', [$course, $material]) }}"
                                          method="POST"
                                          class="flex-1"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex w-full items-center justify-center rounded-xl px-4 py-2
                                                       border border-red-400/25 bg-red-500/10 text-red-200
                                                       hover:bg-red-500/20 hover:scale-[1.01]
                                                       transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

                            <div class="px-5 py-4 text-xs text-gray-400 flex items-center justify-between">
                                <span class="truncate">Keep your course resources organized</span>
                                <span class="opacity-60 group-hover:opacity-100 transition">✨</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur px-4 py-3 shadow-lg">
                        {{ $materials->links() }}
                    </div>
                </div>
            @else
                <!-- Empty state -->
                <div class="flex flex-col items-center justify-center rounded-2xl border border-white/10 bg-white/5 backdrop-blur px-6 py-14 text-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl border border-white/10 bg-white/5 shadow">
                        <span class="text-2xl">📦</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">No materials found</h2>
                    <p class="mt-2 max-w-md text-sm text-gray-300">
                        Upload PDFs, slides, or resources so students can access them from this course page.
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('lesson_materials.create', $course) }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3
                                  bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                                  text-white font-semibold shadow-lg shadow-purple-500/25
                                  hover:shadow-purple-500/45 hover:scale-[1.02]
                                  transition-all duration-300">
                            Upload First Material
                            <span class="opacity-80">↗</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </x-sidenavbar-container>

</x-layout>
