<x-layout>
    <x-slot:heading>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">
                    {{ $course->title ?? $course->name }}
                </h1>
                <p class="mt-1 text-sm text-gray-300">
                    All materials and assignments for this course.
                </p>
            </div>

            <a href=""
               class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3
                      border border-white/10 bg-white/5 text-white font-semibold
                      hover:bg-white/10 hover:scale-[1.01] transition-all">
                ← Back to My Courses
            </a>
        </div>
    </x-slot:heading>

    <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 shadow-2xl p-6">
        <div class="pointer-events-none absolute -top-28 -right-24 h-72 w-72 rounded-full bg-fuchsia-600/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -left-24 h-72 w-72 rounded-full bg-indigo-600/20 blur-3xl"></div>

        <div class="grid gap-6 lg:grid-cols-2">
            {{-- Materials --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-white font-semibold tracking-tight">Lesson Materials</div>
                        <div class="mt-1 text-sm text-gray-300">{{ $materials->count() }} item(s)</div>
                    </div>
                    <div class="h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center">
                        📚
                    </div>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse($materials as $m)
                        <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="text-white font-semibold truncate">{{ $m->title ?? $m->name ?? 'Material' }}</div>
                                    <div class="mt-1 text-xs text-gray-400">Uploaded: {{ optional($m->created_at)->format('M d, Y') }}</div>
                                </div>

                                <a href="{{ \Illuminate\Support\Facades\Storage::url($m->file_path) }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2
                                          bg-gradient-to-r from-blue-500/90 to-indigo-600/90
                                          text-white font-semibold shadow-md shadow-indigo-500/20
                                          hover:shadow-indigo-500/35 hover:scale-[1.01] transition-all">
                                    View ↗
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-white/10 bg-white/5 p-6 text-center text-sm text-gray-300">
                            No materials yet.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Assignments --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-white font-semibold tracking-tight">Assignments</div>
                        <div class="mt-1 text-sm text-gray-300">{{ $assignments->count() }} item(s)</div>
                    </div>
                    <div class="h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center">
                        ✅
                    </div>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse($assignments as $a)
                        @php
                            $isQuiz = $a->type === 'quiz';
                            $submitted = (bool)($a->my_submission ?? null);
                        @endphp

                        <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <div class="text-white font-semibold truncate">{{ $a->title }}</div>

                                        <span class="inline-flex items-center rounded-full border border-indigo-400/25 bg-indigo-500/10 px-3 py-1 text-xs font-medium text-indigo-200">
                                            {{ strtoupper($a->type) }}
                                        </span>

                                        @if($submitted)
                                            <span class="inline-flex items-center rounded-full border border-emerald-400/25 bg-emerald-500/10 px-3 py-1 text-xs font-medium text-emerald-200">
                                                Submitted
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                                                Not submitted
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-2 text-xs text-gray-400">
                                        @if($a->lesson)
                                            Material: <span class="text-gray-200">{{ $a->lesson->title ?? 'Lesson Material' }}</span> •
                                        @endif
                                        Max score: <span class="text-gray-200">{{ $a->max_score ?? 0 }}</span>
                                        @if($a->due_at)
                                            • Due: <span class="text-gray-200">{{ $a->due_at->format('M d, Y h:i A') }}</span>
                                        @endif
                                    </div>

                                    @if($isQuiz)
                                        <div class="mt-2 text-xs text-gray-400">
                                            Questions: <span class="text-gray-200">{{ $a->questions?->count() ?? 0 }}</span>
                                            @if($a->time_limit_minutes)
                                                • Time: <span class="text-gray-200">{{ $a->time_limit_minutes }} min</span>
                                            @endif
                                            @if($a->attempt_limit)
                                                • Attempts: <span class="text-gray-200">{{ $a->attempt_limit }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <a href="{{ route('assignments.show', $a) }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2
                                          border border-white/10 bg-white/5 text-white font-semibold
                                          hover:bg-white/10 hover:scale-[1.01] transition-all">
                                    Open ↗
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-white/10 bg-white/5 p-6 text-center text-sm text-gray-300">
                            No assignments yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-layout>
