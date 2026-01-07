<x-layout>
    @php
        $lesson = $assignment->lesson ?? null;   // LessonMaterial
        $course = $lesson?->course ?? null;      // Course
    @endphp

    <x-slot:heading>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">{{ $assignment->title }}</h1>

                <div class="mt-2 flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-full border border-indigo-400/25 bg-indigo-500/10 px-3 py-1 text-xs font-medium text-indigo-200">
                        {{ strtoupper($assignment->type) }}
                    </span>

                    @if($assignment->is_published)
                        <span class="inline-flex items-center rounded-full border border-emerald-400/25 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-200">
                            Published
                        </span>
                    @else
                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                            Draft
                        </span>
                    @endif

                    @if($course)
                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                            Course: <span class="ml-1 font-medium text-gray-100">{{ $course->title ?? $course->name }}</span>
                        </span>
                    @endif

                    @if($lesson)
                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                            Material: <span class="ml-1 font-medium text-gray-100">{{ $lesson->title ?? 'Lesson Material' }}</span>
                        </span>
                    @endif
                </div>

                <p class="mt-3 text-sm text-gray-300">
                    {{ $assignment->description ?: 'No description provided.' }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if($lesson)
                    <a href="{{ route('lesson_materials.index', $lesson->course_id) }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3
                              border border-white/10 bg-white/5 text-white font-semibold
                              hover:bg-white/10 hover:scale-[1.01] transition-all">
                        ← Back to Materials
                    </a>
                @endif

                <a href="{{ route('assignments.edit', $assignment) }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3
                          border border-yellow-400/25 bg-yellow-500/10 text-yellow-200 font-semibold
                          hover:bg-yellow-500/20 hover:scale-[1.01] transition-all">
                    Edit
                </a>
            </div>
        </div>
    </x-slot:heading>

    <x-sidenavbar-container>
        @if($course)
            <x-sidenavbar :course="$course"></x-sidenavbar>
        @endif

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-400/25 bg-emerald-500/10 backdrop-blur
                        px-5 py-4 text-emerald-200 shadow-lg">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_20px_rgba(52,211,153,0.55)]"></div>
                    <div class="font-medium">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 shadow-2xl mt-12 ml-36">
            <div class="pointer-events-none absolute -top-28 -right-24 h-72 w-72 rounded-full bg-fuchsia-600/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-28 -left-24 h-72 w-72 rounded-full bg-indigo-600/20 blur-3xl"></div>

            <div class="relative p-6 space-y-6">

                {{-- Submission status --}}
                <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <div class="text-white font-semibold tracking-tight">Your Submission</div>
                            <div class="mt-1 text-sm text-gray-300">
                                @if($submission)
                                    Submitted ✅
                                @else
                                    Not submitted yet
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                                Max score: <span class="ml-1 font-medium text-gray-100">{{ $assignment->max_score ?? 0 }}</span>
                            </span>

                            @if($assignment->due_at)
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                                    Due: <span class="ml-1 font-medium text-gray-100">{{ $assignment->due_at->format('M d, Y h:i A') }}</span>
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                                    No due date
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($submission)
                        <div class="mt-4 rounded-2xl border border-white/10 bg-black/20 p-5">
                            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                                <div>
                                    <div class="text-xs text-gray-400">Submitted at</div>
                                    <div class="mt-1 text-sm font-semibold text-white">
                                        {{ optional($submission->created_at)->format('M d, Y h:i A') }}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-400">Score</div>
                                    <div class="mt-1 text-sm font-semibold text-white">
                                        {{ $submission->score ?? '—' }}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-400">Status</div>
                                    <div class="mt-1 text-sm font-semibold text-white">
                                        {{ $submission->status ?? 'submitted' }}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-xs text-gray-400">Feedback</div>
                                    <div class="mt-1 text-sm font-semibold text-white">
                                        {{ $submission->feedback ? 'Available' : '—' }}
                                    </div>
                                </div>
                            </div>

                            @if(!empty($submission->feedback))
                                <div class="mt-4 rounded-xl border border-white/10 bg-white/5 p-4 text-sm text-gray-200">
                                    {{ $submission->feedback }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Assignment content --}}
                @if($assignment->type === 'quiz')
                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <div class="text-white font-semibold tracking-tight">Quiz Questions</div>
                                <div class="mt-1 text-sm text-gray-300">
                                    {{ $assignment->questions->count() }} question(s)
                                </div>
                            </div>

                            <a href="{{ route('assignments.edit', $assignment) }}"
                               class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5
                                      border border-white/10 bg-white/5 text-white font-semibold
                                      hover:bg-white/10 hover:scale-[1.01] transition-all">
                                Manage ↗
                            </a>
                        </div>

                        <div class="mt-4 space-y-4">
                            @forelse($assignment->questions as $i => $q)
                                <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <div class="text-xs text-gray-400">
                                                Q{{ $i + 1 }} • {{ strtoupper($q->type ?? 'MCQ') }} • {{ $q->points ?? 1 }} pt
                                            </div>

                                            <div class="mt-1 text-white font-semibold">
                                                {{ $q->prompt }}
                                            </div>

                                            @if(($q->type ?? '') === 'mcq' && !empty($q->options_text))
                                                <div class="mt-3 grid gap-2 sm:grid-cols-2">
                                                    @foreach(preg_split("/\r\n|\n|\r/", $q->options_text) as $opt)
                                                        @if(trim($opt) !== '')
                                                            <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-gray-200">
                                                                {{ $opt }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        @if(!empty($q->correct_answer))
                                            <div class="shrink-0 rounded-xl border border-emerald-400/25 bg-emerald-500/10 px-3 py-2 text-xs font-medium text-emerald-200">
                                                Answer set
                                            </div>
                                        @else
                                            <div class="shrink-0 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-xs text-gray-300">
                                                Manual grade
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-2xl border border-dashed border-white/10 bg-white/5 p-6 text-center text-sm text-gray-300">
                                    No questions added yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                        <div class="text-white font-semibold tracking-tight">Recording Settings</div>
                        <div class="mt-1 text-sm text-gray-300">
                            Students upload an audio file. Max file size:
                            <span class="font-semibold text-white">{{ $assignment->max_file_mb ?? 30 }} MB</span>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </x-sidenavbar-container>
</x-layout>
