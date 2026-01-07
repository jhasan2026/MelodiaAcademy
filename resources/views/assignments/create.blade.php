<x-layout>
    <x-slot:heading>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Create Assignment</h1>
                <p class="mt-1 text-sm text-gray-300">
                    Add a quiz or recording task for
                    <span class="font-semibold text-gray-100">{{ $lesson->title ?? $lesson->name ?? 'Lesson Material' }}</span>
                    in
                    <span class="font-semibold text-gray-100">
                        {{ $lesson->course->title ?? $lesson->course->name ?? 'Course' }}
                    </span>
                </p>
            </div>

            <a href="{{ route('lesson_materials.index', $lesson->course_id) }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3
                      border border-white/10 bg-white/5 text-white font-semibold
                      hover:bg-white/10 hover:scale-[1.01] transition-all">
                ← Back to Materials
            </a>
        </div>
    </x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$lesson->course"></x-sidenavbar>

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-400/25 bg-emerald-500/10 backdrop-blur
                        px-5 py-4 text-emerald-200 shadow-lg">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_20px_rgba(52,211,153,0.55)]"></div>
                    <div class="font-medium">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-red-400/25 bg-red-500/10 backdrop-blur
                        px-5 py-4 text-red-200 shadow-lg">
                <div class="font-semibold">Please fix the following:</div>
                <ul class="mt-2 list-disc pl-5 text-sm text-red-200/90">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page container -->
        <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 shadow-2xl mt-12 ml-36">
            <!-- Ambient glows -->
            <div class="pointer-events-none absolute -top-28 -right-24 h-72 w-72 rounded-full bg-fuchsia-600/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-28 -left-24 h-72 w-72 rounded-full bg-indigo-600/20 blur-3xl"></div>

            <form method="POST"
                  action="{{ route('assignments.store', $lesson) }}"
                  class="relative p-6"
                  x-data="assignmentBuilder()">
                @csrf

                <!-- Top info card -->
                <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <div class="text-white font-semibold tracking-tight">Assignment Details</div>
                            <div class="mt-1 text-sm text-gray-300">
                                Choose assignment type, settings, and (if quiz) questions.
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center rounded-full border border-indigo-400/25 bg-indigo-500/10 px-3 py-1 text-xs font-medium text-indigo-200">
                                {{ $lesson->course->title ?? $lesson->course->name ?? 'Course' }}
                            </span>
                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300">
                                {{ $lesson->title ?? 'Material' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium text-gray-200">Title</label>
                            <input name="title" value="{{ old('title') }}" required
                                   class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                          text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                   placeholder="e.g. Week 3 Quiz / Rhythm Practice Recording" />
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-200">Type</label>
                            <select name="type" x-model="type" required
                                    class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                           text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
                                <option value="quiz">Quiz</option>
                                <option value="audio">Music / Audio Recording</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-200">Description</label>
                            <textarea name="description" rows="3"
                                      class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                             text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                      placeholder="Explain what students need to submit...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Rules -->
                <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="text-white font-semibold tracking-tight">Rules & Scoring</div>
                            <div class="mt-1 text-sm text-gray-300">Deadlines, late policy, and points.</div>
                        </div>
                        <div class="text-xs text-gray-400">Draft by default</div>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-4">
                        <div>
                            <label class="text-sm font-medium text-gray-200">Due date</label>
                            <input type="datetime-local" name="due_at" value="{{ old('due_at') }}"
                                   class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                          text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" />
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-200">Max score</label>
                            <input type="number" min="1" name="max_score" value="{{ old('max_score', 100) }}" required
                                   class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                          text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" />
                        </div>

                        <label class="flex items-center gap-2 rounded-2xl border border-white/10 bg-black/20 px-4 py-3">
                            <input type="checkbox" name="allow_late" value="1" class="rounded border-white/20 bg-black/30">
                            <span class="text-sm text-gray-200">Allow late</span>
                        </label>

                        <label class="flex items-center gap-2 rounded-2xl border border-white/10 bg-black/20 px-4 py-3">
                            <input type="checkbox" name="allow_resubmit" value="1" class="rounded border-white/20 bg-black/30">
                            <span class="text-sm text-gray-200">Allow resubmit</span>
                        </label>
                    </div>
                </div>

                <!-- QUIZ -->
                <div x-show="type === 'quiz'" x-cloak
                     class="mt-6 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="text-white font-semibold tracking-tight">Quiz Settings</div>
                            <div class="mt-1 text-sm text-gray-300">Add questions and correct answers (optional).</div>
                        </div>

                        <label class="flex items-center gap-2 rounded-2xl border border-white/10 bg-black/20 px-4 py-3">
                            <input type="checkbox" name="auto_grade" value="1" checked class="rounded border-white/20 bg-black/30">
                            <span class="text-sm text-gray-200">Auto-grade</span>
                        </label>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div>
                            <label class="text-sm font-medium text-gray-200">Time limit (minutes)</label>
                            <input type="number" min="1" name="time_limit_minutes" value="{{ old('time_limit_minutes') }}"
                                   class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                          text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" />
                            <p class="mt-1 text-xs text-gray-400">Leave empty for unlimited.</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-200">Attempt limit</label>
                            <input type="number" min="1" name="attempt_limit" value="{{ old('attempt_limit') }}"
                                   class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                          text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" />
                            <p class="mt-1 text-xs text-gray-400">Leave empty for unlimited.</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between gap-3">
                            <div class="text-white font-semibold tracking-tight">Questions</div>
                            <button type="button" @click="addQuestion()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5
                                           bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                                           text-white font-semibold shadow-lg shadow-purple-500/25
                                           hover:shadow-purple-500/45 hover:scale-[1.02]
                                           transition-all duration-300">
                                + Add Question
                            </button>
                        </div>

                        <div class="mt-4 space-y-4">
                            <template x-for="(q, idx) in questions" :key="q.key">
                                <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="w-full">
                                            <div class="grid gap-3 md:grid-cols-3">
                                                <div class="md:col-span-2">
                                                    <label class="text-sm font-medium text-gray-200">Prompt</label>
                                                    <textarea :name="`questions[${idx}][prompt]`" x-model="q.prompt" rows="2" required
                                                              class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                                                     text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                                              placeholder="Write the question..."></textarea>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium text-gray-200">Type</label>
                                                    <select :name="`questions[${idx}][type]`" x-model="q.type"
                                                            class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                                                   text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40">
                                                        <option value="mcq">MCQ</option>
                                                        <option value="tf">True/False</option>
                                                        <option value="short">Short Answer</option>
                                                    </select>

                                                    <label class="mt-3 block text-sm font-medium text-gray-200">Points</label>
                                                    <input type="number" min="1" :name="`questions[${idx}][points]`" x-model="q.points" required
                                                           class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                                                  text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" />
                                                </div>
                                            </div>

                                            <div class="mt-3 grid gap-3 md:grid-cols-2">
                                                <div x-show="q.type === 'mcq'" x-cloak>
                                                    <label class="text-sm font-medium text-gray-200">MCQ Options (one per line)</label>
                                                    <textarea :name="`questions[${idx}][options_text]`" x-model="q.options_text" rows="3"
                                                              class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                                                     text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                                              placeholder="Option A&#10;Option B&#10;Option C"></textarea>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium text-gray-200">Correct answer (optional)</label>
                                                    <input :name="`questions[${idx}][correct_answer]`" x-model="q.correct_answer"
                                                           class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                                                  text-gray-100 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                                           placeholder="For TF: true/false. For MCQ: exact option text." />
                                                    <p class="mt-1 text-xs text-gray-400">Leave empty for manual grading.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" @click="removeQuestion(idx)"
                                                class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-gray-200
                                                       hover:bg-white/10 transition">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <div x-show="questions.length === 0"
                                 class="rounded-2xl border border-dashed border-white/10 bg-white/5 p-6 text-center text-sm text-gray-300">
                                No questions yet. Click <span class="font-semibold text-white">Add Question</span>.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AUDIO -->
                <div x-show="type === 'audio'" x-cloak
                     class="mt-6 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-lg">
                    <div class="text-white font-semibold tracking-tight">Recording Settings</div>
                    <div class="mt-1 text-sm text-gray-300">Students upload audio for evaluation.</div>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div>
                            <label class="text-sm font-medium text-gray-200">Max file size (MB)</label>
                            <input type="number" min="1" max="500" name="max_file_mb" value="{{ old('max_file_mb', 30) }}"
                                   class="mt-2 w-full rounded-xl border border-white/10 bg-black/30 px-4 py-3
                                          text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" />
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-3">
                    <a href="{{ route('lesson_materials.index', $lesson->course_id) }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3
                              border border-white/10 bg-white/5 text-white font-semibold
                              hover:bg-white/10 hover:scale-[1.01] transition-all">
                        Cancel
                    </a>

                    <button type="submit"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3
                                   bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                                   text-white font-semibold shadow-lg shadow-purple-500/25
                                   hover:shadow-purple-500/45 hover:scale-[1.02]
                                   transition-all duration-300">
                        Create Draft
                        <span class="opacity-80 group-hover:opacity-100 transition">↗</span>
                    </button>
                </div>
            </form>
        </div>

        <script>
            function assignmentBuilder() {
                return {
                    type: 'quiz',
                    questions: [
                        { key: crypto.randomUUID(), type: 'mcq', prompt: '', options_text: '', correct_answer: '', points: 1 }
                    ],
                    addQuestion() {
                        this.questions.push({ key: crypto.randomUUID(), type: 'mcq', prompt: '', options_text: '', correct_answer: '', points: 1 });
                    },
                    removeQuestion(i) {
                        this.questions.splice(i, 1);
                    }
                }
            }
        </script>
    </x-sidenavbar-container>
</x-layout>
