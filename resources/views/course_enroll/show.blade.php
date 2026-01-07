<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Course
    </x-slot:heading>

    <x-sidenavbar-container>

        <x-sidenavbar-student :course="$course"></x-sidenavbar-student>


        <section class="w-full body-font bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white ml-4">
        <!-- Hero -->
        <div class="container mx-auto px-5 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                <div class="relative">
                    <div class="absolute -inset-3 rounded-[2rem] bg-gradient-to-r from-indigo-500/25 via-sky-500/20 to-emerald-500/25 blur-2xl"></div>
                    <div class="relative rounded-[2rem] overflow-hidden border border-white/10 bg-white/5 shadow-2xl">
                        <img class="w-full lg:h-[430px] md:h-[380px] h-72 object-cover object-center"
                             alt="hero"
                             src="{{ asset('storage/' . $course->instrument_image) }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 via-transparent to-transparent"></div>
                    </div>
                </div>

                <div class="md:pt-2">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-sm text-white/80 mb-4">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        Course
                    </div>

                    <h1 class="title-font sm:text-5xl text-4xl mb-4 font-semibold tracking-tight text-white">
                        {{ $course->name }}
                    </h1>

                    <p class="mb-8 leading-relaxed text-white/75">
                        {{ $course->description }}
                    </p>

                    <!-- Stats pills -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <p class="text-xs text-white/60">Rating</p>
                            <p class="text-xl font-semibold">{{ $course->rating }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <p class="text-xs text-white/60">Fees</p>
                            <p class="text-xl font-semibold">{{ $course->payment }} <span class="text-sm text-white/60">Tk.</span></p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 col-span-2 sm:col-span-1">
                            <p class="text-xs text-white/60">Level</p>
                            <p class="text-xl font-semibold">{{ ucfirst($course->course_level) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Topics -->
            <div class="mt-14 max-w-5xl mx-auto">
                <div class="rounded-3xl overflow-hidden border border-white/10 bg-white/5 backdrop-blur shadow-xl shadow-black/30">
                    <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
                        <h1 class="text-white font-semibold text-2xl tracking-tight">List of topic</h1>
                        <span class="text-sm text-white/70">
                            {{ $course->course_topic()->count() }}
                        </span>
                    </div>

                    <ul class="divide-y divide-white/10">
                        @foreach($course->course_topic()->oldest()->get() as $topic)
                            <li class="px-6 py-4 hover:bg-white/5 transition-colors text-white">
                                <x-topic-list class="text-white">{{ $topic->topic }}</x-topic-list>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Big stats -->
            <section class="mt-14 border-t border-white/10">
                <div class="container py-16 mx-auto">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 text-center">
                        <div class="rounded-3xl border border-white/10 bg-white/5 px-5 py-6 shadow-lg shadow-black/20">
                            <h2 class="title-font font-semibold sm:text-5xl text-4xl text-white mb-1">{{ $course->rating }}</h2>
                            <p class="text-white/70">Rating</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 px-5 py-6 shadow-lg shadow-black/20">
                            <h2 class="title-font font-semibold sm:text-5xl text-4xl text-white mb-1">{{ $course->payment }} <span class="text-lg text-white/70">Tk.</span></h2>
                            <p class="text-white/70">Fees</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 px-5 py-6 shadow-lg shadow-black/20">
                            <h2 class="title-font font-semibold sm:text-5xl text-4xl text-white mb-1">{{ $course->instrument_name }}</h2>
                            <p class="text-white/70">Instrument Name</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 px-5 py-6 shadow-lg shadow-black/20">
                            <h2 class="title-font font-semibold sm:text-5xl text-4xl text-white mb-1">{{ $course->duration_week }}</h2>
                            <p class="text-white/70">Duration Week</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 px-5 py-6 shadow-lg shadow-black/20">
                            <h2 class="title-font font-semibold sm:text-5xl text-4xl text-white mb-1">{{ ucfirst($course->course_level) }}</h2>
                            <p class="text-white/70">Courses Level</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Reviews -->
        <section class="py-8 lg:py-16 antialiased">
            <div class="max-w-4xl mx-auto px-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-white">Review</h2>
                </div>

                @if(auth()->check())
                    <form class="mb-8" action="{{ route('courses.comments.store', $course->id) }}" method="POST">
                        @csrf

                        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur shadow-lg shadow-black/20 p-5">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-start">
                                <!-- Comment Box -->
                                <div class="md:col-span-4 rounded-2xl border border-white/10 bg-slate-950/30 p-4">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <textarea id="comment" name="comment" rows="5"
                                              class="w-full bg-transparent text-sm text-white placeholder:text-white/40 border-0 focus:ring-0 focus:outline-none"
                                              placeholder="Write a comment..." required></textarea>
                                </div>

                                <!-- Rating Stars -->
                                <div class="md:col-span-1">
                                    <label class="text-white/80 font-semibold text-sm">Rating</label>

                                    <input type="hidden" name="rating" id="rating" value="0">

                                    <div class="flex items-center mt-2 gap-1" id="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button" data-value="{{ $i }}"
                                                    class="star inline-flex justify-center items-center rounded-xl p-2 bg-white/5 border border-white/10 text-white/30 hover:text-yellow-400 hover:bg-white/10 transition">
                                                <svg class="shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>

                                    <button type="submit"
                                            class="mt-4 w-full inline-flex items-center justify-center gap-2 rounded-2xl px-4 py-3 text-sm font-semibold
                                                   bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-lg shadow-indigo-900/30
                                                   hover:from-indigo-500 hover:to-violet-500 transition">
                                        Post
                                        <svg class="w-5 h-5 opacity-90" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif

                <div class="space-y-4">
                    @foreach($course->comments as $comment)
                        <article class="p-6 rounded-3xl border border-white/10 bg-white/5 backdrop-blur shadow-lg shadow-black/20">
                            <footer class="flex justify-between items-start gap-4 mb-3">
                                <div class="flex items-center min-w-0">
                                    <img class="mr-3 w-10 h-10 rounded-full ring-2 ring-white/10 object-cover"
                                         src="{{ $comment->user->profile && $comment->user->profile->profile_pic ? asset($comment->user->profile->profile_pic) : asset('images/default.jpg') }}"
                                         alt="User">
                                    <div class="min-w-0">
                                        <p class="text-sm text-white font-semibold truncate">
                                            {{ $comment->user->first_name . " " . $comment->user->last_name }}
                                        </p>
                                        <p class="text-xs text-white/60">
                                            <time pubdate datetime="2022-02-08" title="February 8th, 2022">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </time>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if($i <= $comment->rating)
                                                <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-white/20" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>

                                    @if(auth()->id() === $comment->user_id)
                                        <button
                                            id="dropdownCommentButton-{{ $comment->id }}"
                                            data-dropdown-toggle="dropdownComment-{{ $comment->id }}"
                                            type="button"
                                            class="inline-flex items-center justify-center h-10 w-10 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 text-white/70 transition"
                                        >
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                                <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                            </svg>
                                            <span class="sr-only">Comment settings</span>
                                        </button>
                                    @endif

                                    <div
                                        id="dropdownComment-{{ $comment->id }}"
                                        class="absolute right-0 mt-12 hidden z-50 w-40 overflow-hidden rounded-2xl border border-white/10
                                               bg-slate-950/90 backdrop-blur shadow-2xl"
                                    >
                                        <ul class="py-1 text-sm text-white/80">
                                            <li>
                                                <button type="button"
                                                        onclick="toggleEdit({{ $comment->id }})"
                                                        class="block w-full text-left px-4 py-2 hover:bg-white/10">
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="block w-full text-left px-4 py-2 hover:bg-white/10">
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </footer>

                            <div id="comment-text-{{ $comment->id }}">
                                <p class="text-white/75 leading-relaxed">
                                    {{ $comment->comment }}
                                </p>
                            </div>

                            @if(auth()->id() === $comment->user_id)
                                <form id="edit-form-{{ $comment->id }}"
                                      action="{{ route('comments.update', $comment->id) }}"
                                      method="POST"
                                      class="hidden mt-4">
                                    @csrf
                                    @method('PUT')

                                    <textarea name="comment" rows="4"
                                              class="w-full rounded-2xl p-3 text-sm text-white bg-slate-950/30 border border-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                                              required>{{ $comment->comment }}</textarea>

                                    <div class="flex gap-2 mt-3">
                                        <button type="submit"
                                                class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors">
                                            Update
                                        </button>

                                        <button type="button"
                                                onclick="toggleEdit({{ $comment->id }})"
                                                class="px-4 py-2 text-sm bg-white/10 text-white rounded-xl hover:bg-white/15 transition-colors">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <script>
            function toggleEdit(commentId) {
                const text = document.getElementById(`comment-text-${commentId}`);
                const form = document.getElementById(`edit-form-${commentId}`);
                text.classList.toggle('hidden');
                form.classList.toggle('hidden');
            }

            document.addEventListener('DOMContentLoaded', () => {
                const stars = document.querySelectorAll('#star-rating .star');
                const ratingInput = document.getElementById('rating');
                let currentRating = 0;

                stars.forEach(star => {
                    star.addEventListener('mouseover', () => {
                        const val = parseInt(star.dataset.value);
                        highlightStars(val);
                    });

                    star.addEventListener('mouseout', () => {
                        highlightStars(currentRating);
                    });

                    star.addEventListener('click', () => {
                        currentRating = parseInt(star.dataset.value);
                        ratingInput.value = currentRating;
                        highlightStars(currentRating);
                    });
                });

                function highlightStars(rating) {
                    stars.forEach(star => {
                        if (parseInt(star.dataset.value) <= rating) {
                            star.classList.add('text-yellow-400');
                            star.classList.remove('text-white/30');
                        } else {
                            star.classList.add('text-white/30');
                            star.classList.remove('text-yellow-400');
                        }
                    });
                }
            });
        </script>
    </section>
    </x-sidenavbar-container>
</x-layout>
