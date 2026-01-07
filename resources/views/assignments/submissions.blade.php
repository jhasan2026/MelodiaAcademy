<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Submissions</h1>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $assignment->title }} • {{ strtoupper($assignment->type) }}
                </p>
            </div>
            <a href="{{ route('assignments.edit', $assignment) }}" class="rounded-xl border px-4 py-2 text-sm hover:bg-gray-50">
                Back to edit
            </a>
        </div>

        <div class="mt-6">@include('components.flash')</div>

        <div class="mt-6 overflow-hidden rounded-2xl border bg-white shadow-sm">
            <div class="grid grid-cols-12 border-b bg-gray-50 px-4 py-3 text-xs font-semibold text-gray-600">
                <div class="col-span-4">Student</div>
                <div class="col-span-3">Submitted</div>
                <div class="col-span-2">Score</div>
                <div class="col-span-3">Actions</div>
            </div>

            <div class="divide-y">
                @forelse($assignment->submissions as $s)
                    <div class="grid grid-cols-12 items-start gap-3 px-4 py-4">
                        <div class="col-span-4">
                            <div class="text-sm font-semibold">{{ $s->student->name ?? 'Student' }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $s->student_id }}</div>
                        </div>

                        <div class="col-span-3 text-sm text-gray-700">
                            {{ $s->submitted_at ? $s->submitted_at->format('M d, Y h:i A') : '—' }}
                        </div>

                        <div class="col-span-2">
                            <span class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-700">
                                {{ is_null($s->score) ? '—' : $s->score }}
                            </span>
                        </div>

                        <div class="col-span-12 mt-3 rounded-2xl border p-4 md:col-span-12">
                            @if($assignment->type === 'audio' && $s->audio_path)
                                <div class="text-sm font-semibold">Recording</div>
                                <div class="mt-1 text-sm text-gray-700">{{ $s->audio_original_name }}</div>
                                <audio controls class="mt-3 w-full"
                                       src="{{ Storage::disk('public')->url($s->audio_path) }}"></audio>
                            @endif

                            @if($assignment->type === 'quiz')
                                <div class="text-sm font-semibold">Answers</div>
                                <div class="mt-2 space-y-2 text-sm">
                                    @foreach($assignment->questions as $q)
                                        <div class="rounded-xl bg-gray-50 p-3">
                                            <div class="font-medium">{{ $q->prompt }}</div>
                                            <div class="mt-1 text-gray-700">
                                                Answer: <span class="font-semibold">{{ $s->answers[$q->id] ?? '—' }}</span>
                                                @if($q->correct_answer)
                                                    <span class="text-xs text-gray-500"> • Correct: {{ $q->correct_answer }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('assignments.grade', [$assignment, $s]) }}" class="mt-4 grid gap-3 md:grid-cols-6">
                                @csrf
                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-600">Score</label>
                                    <input type="number" name="score" min="0" max="{{ $assignment->max_score }}"
                                           value="{{ old('score', $s->score) }}"
                                           class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                                </div>
                                <div class="md:col-span-4">
                                    <label class="text-xs font-semibold text-gray-600">Feedback</label>
                                    <input type="text" name="feedback" value="{{ old('feedback', $s->feedback) }}"
                                           class="mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                           placeholder="Write quick feedback..." />
                                </div>
                                <div class="md:col-span-1 flex items-end">
                                    <button class="w-full rounded-xl bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-black">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-sm text-gray-600">No submissions yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
