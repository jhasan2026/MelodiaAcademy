<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Create Course
    </x-slot:heading>

    <section class="text-gray-600 body-font mb-4 bg-gradient-to-br from-slate-50 via-white to-indigo-50">
        <div class="pt-16">
            <div class="max-w-5xl mx-auto rounded-3xl overflow-hidden border border-slate-200/70 bg-white/70 backdrop-blur shadow-[0_20px_60px_-30px_rgba(15,23,42,0.35)]">
                <!-- Header -->
                <div class="px-7 py-6 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/70 text-sm font-medium">Create Course</p>
                            <h1 class="text-white text-2xl font-semibold tracking-tight">Course Topics</h1>
                        </div>
                        <div class="flex items-center gap-2 rounded-2xl bg-white/10 border border-white/10 px-4 py-2">
                            <svg class="w-4 h-4 text-white/70" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M5 19h14M7 15h10" />
                            </svg>
                            <span class="text-white font-semibold">{{ $course->course_topic()->count() }}</span>
                            <span class="text-white/70 text-sm">topics</span>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="p-7">
                    <form class="w-full max-w-4xl mx-auto" method="post" action="{{ route('topics.store', $course->id) }}">
                        @csrf

                        <div class="relative">
                            <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-indigo-400/30 via-sky-400/30 to-violet-400/30 blur-lg"></div>

                            <div class="relative flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-3 shadow-sm">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-white">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </span>

                                <input
                                    class="appearance-none bg-transparent border-none w-full text-slate-900 placeholder:text-slate-400 py-2 px-2 leading-tight focus:outline-none"
                                    type="text" name="topic" placeholder="Type a topic name and press Add">

                                <button
                                    class="inline-flex items-center justify-center gap-2 flex-shrink-0 rounded-2xl px-5 py-3 text-sm font-semibold
                                           bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-lg shadow-indigo-200/60
                                           hover:from-indigo-500 hover:to-violet-500 transition"
                                    type="submit">
                                    Add Topic
                                    <svg class="w-5 h-5 opacity-90" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- List -->
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-slate-900 font-semibold text-lg">Topics</h2>
                            <span class="text-slate-500 text-sm">Oldest first</span>
                        </div>

                        <ul class="space-y-3">
                            @foreach($course->course_topic()->oldest()->get() as $topic)
                                <li class="group">
                                    <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm hover:shadow-md transition">
                                        <div class="flex items-start gap-3">
                                            <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5h13M8 12h13M8 19h13M3 5h.01M3 12h.01M3 19h.01" />
                                                </svg>
                                            </span>
                                            <div class="text-slate-800">
                                                <x-topic-list>{{ $topic->topic }}</x-topic-list>
                                            </div>
                                        </div>

                                        <span class="hidden sm:inline-flex text-slate-400 group-hover:text-slate-700 transition">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save -->
        <div class="w-full mt-10 flex justify-center">
            <a href="{{ route('courses.index') }}"
               class="group inline-flex items-center justify-center gap-2 rounded-2xl px-7 py-3 text-base font-semibold
                      bg-slate-900 text-white shadow-xl shadow-slate-300/50 hover:bg-slate-800 transition">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/10 border border-white/10">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
                Save
                <svg class="w-5 h-5 opacity-80 transition-transform duration-300 group-hover:translate-x-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </section>
</x-layout>
