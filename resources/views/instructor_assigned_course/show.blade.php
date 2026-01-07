<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>Instructor Assigned Courses</x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course"></x-sidenavbar>

        <!-- Background -->
        <section class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-slate-100 mt-8 ml-12">
            <div class="container mx-auto px-5 py-10 lg:py-14">

                <!-- Top bar / breadcrumb-ish -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-slate-300/80">Instructor Panel</p>
                        <h2 class="text-2xl md:text-3xl font-semibold tracking-tight">
                            Instructor Assigned Courses
                        </h2>
                    </div>

                    <!-- Optional action button (remove if not needed) -->
                    <div class="hidden sm:flex gap-2">
                        <button
                            class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium hover:bg-white/10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                            New Topic
                        </button>
                    </div>
                </div>

                <!-- Main card -->
                <div
                    class="relative overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-xl">
                    <!-- Glow -->
                    <div class="pointer-events-none absolute -top-24 -right-24 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-fuchsia-500/10 blur-3xl"></div>

                    <div class="p-6 md:p-10">
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                            <!-- Image -->
                            <div class="lg:col-span-5">
                                <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-slate-900/40">
                                    <img
                                        class="h-72 w-full object-cover object-center transition duration-500 group-hover:scale-[1.03]"
                                        alt="course image"
                                        src="{{ asset('storage/' . $course->instrument_image) }}"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>

                                    <!-- Badge -->
                                    <div class="absolute left-4 top-4">
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs font-medium text-slate-100">
                      <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                      Active Course
                    </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="lg:col-span-7">
                                <div class="flex flex-col gap-5">
                                    <div>
                                        <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-white">
                                            {{ $course->name }}
                                        </h1>
                                        <p class="mt-2 text-slate-200/80 leading-relaxed">
                                            {{ $course->description }}
                                        </p>
                                    </div>

                                    <!-- Meta chips -->
                                    <div class="flex flex-wrap gap-2">
                    <span class="rounded-full bg-indigo-500/15 text-indigo-200 border border-indigo-400/20 px-3 py-1 text-xs font-medium">
                      Instructor View
                    </span>
                                        <span class="rounded-full bg-fuchsia-500/10 text-fuchsia-200 border border-fuchsia-400/20 px-3 py-1 text-xs font-medium">
                      Topics Included
                    </span>
                                        <span class="rounded-full bg-white/5 text-slate-200 border border-white/10 px-3 py-1 text-xs font-medium">
                      Updated recently
                    </span>
                                    </div>

                                    <!-- Divider -->
                                    <div class="h-px w-full bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>

                                    <!-- Quick info blocks (optional) -->
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                            <p class="text-xs text-slate-300/80">Course Type</p>
                                            <p class="mt-1 font-semibold text-white">Instrument</p>
                                        </div>
                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                            <p class="text-xs text-slate-300/80">Topics</p>
                                            <p class="mt-1 font-semibold text-white">
                                                {{ $course->course_topic()->count() }}
                                            </p>
                                        </div>
                                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                            <p class="text-xs text-slate-300/80">Status</p>
                                            <p class="mt-1 font-semibold text-emerald-300">Active</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Topics -->
                <div class="mt-8">
                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <h3 class="text-xl md:text-2xl font-semibold text-white">Topics</h3>
                            <p class="text-sm text-slate-300/80">Your course roadmap at a glance</p>
                        </div>

                        <div class="text-sm text-slate-300/80">
                            Total: <span class="text-white font-semibold">{{ $course->course_topic()->count() }}</span>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/5 shadow-xl backdrop-blur-xl overflow-hidden">
                        <ul class="divide-y divide-white/10">
                            @foreach($course->course_topic()->oldest()->get() as $topic)
                                <li class="group px-5 md:px-7 py-4 hover:bg-white/5 transition">
                                    <div class="flex items-start gap-4">
                                        <!-- icon bubble -->
                                        <div class="mt-0.5 flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-500/15 border border-indigo-400/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 5h6M9 9h6M9 13h6M9 17h6M5 5h.01M5 9h.01M5 13h.01M5 17h.01" />
                                            </svg>
                                        </div>

                                        <div class="flex-1">
                                            <p class="text-white font-medium group-hover:text-indigo-100 transition">
                                                {{ $topic->topic }}
                                            </p>
                                            <p class="text-sm text-slate-300/70 mt-0.5">
                                                Tap to view details (optional)
                                            </p>
                                        </div>

                                        <div class="flex items-center gap-2">
                      <span class="hidden sm:inline-flex rounded-full bg-white/5 border border-white/10 px-3 py-1 text-xs text-slate-200">
                        Lesson
                      </span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-5 w-5 text-slate-300/70 group-hover:text-white transition"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Footer -->
                        <div class="px-5 md:px-7 py-4 bg-white/5 border-t border-white/10 flex items-center justify-between">
                            <p class="text-sm text-slate-300/80">
                                Keep topics short & consistent for a cleaner roadmap.
                            </p>
                            <button class="text-sm font-medium text-indigo-200 hover:text-indigo-100 transition">
                                Manage Topics →
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </x-sidenavbar-container>
</x-layout>
