<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Course
    </x-slot:heading>

    <section class="body-font bg-gradient-to-b from-gray-950 via-gray-900 to-gray-950 text-white">
        <div class="container mx-auto px-5 py-16">
            <!-- Hero -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                <div class="relative">
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-r from-emerald-500/30 via-sky-500/30 to-purple-500/30 blur-2xl"></div>
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 bg-white/5 shadow-2xl">
                        <img class="w-full lg:h-[420px] md:h-[380px] h-72 object-cover object-center"
                             alt="hero"
                             src="{{ asset('storage/' . $course->instrument_image) }}">
                    </div>
                </div>

                <div class="md:pt-2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 text-white/80 mb-4">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                        <span class="text-sm font-medium">Course Details</span>
                    </div>

                    <h1 class="title-font sm:text-5xl text-4xl font-semibold tracking-tight text-white mb-4">
                        {{ $course->name }}
                    </h1>

                    <p class="text-white/75 leading-relaxed text-base mb-8">
                        {{ $course->description }}
                    </p>

                    @auth
                        @if($user->role === "student")
                            <div class="flex md:justify-start justify-center">
                                <a href="{{ route('course-enroll.create', $course->id) }}"
                                   class="group inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3 text-base font-semibold
                                          bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400
                                          shadow-lg shadow-emerald-900/30 border border-white/10 transition-all duration-300">
                                    <svg class="w-5 h-5" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                                    </svg>
                                    Enroll Now
                                    <svg class="w-5 h-5 opacity-80 transition-transform duration-300 group-hover:translate-x-0.5"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    @endauth

                    <!-- Quick stats pills -->
                    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <p class="text-white/60 text-xs">Rating</p>
                            <p class="text-xl font-semibold text-white">{{ $course->rating }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                            <p class="text-white/60 text-xs">Fees</p>
                            <p class="text-xl font-semibold text-white">{{ $course->payment }} <span class="text-sm font-medium text-white/70">Tk.</span></p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 col-span-2 sm:col-span-1">
                            <p class="text-white/60 text-xs">Level</p>
                            <p class="text-xl font-semibold text-white">{{ ucfirst($course->course_level) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Topics -->
            <div class="mt-14 max-w-5xl mx-auto">
                <div class="rounded-3xl border border-black/10 bg-white shadow-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h1 class="text-gray-900 font-semibold text-2xl tracking-tight pl-4">List of topic</h1>
                        <span class="text-sm font-medium text-gray-500">
                            {{ $course->course_topic()->count() }}
                        </span>
                    </div>

                    <ul class="divide-y divide-gray-100">
                        @foreach($course->course_topic()->oldest()->get() as $topic)
                            <li class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <x-topic-list>{{ $topic->topic }}</x-topic-list>
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

            <!-- Admin/Instructor actions -->
            <div class="py-10">
                @auth
                    @if($user->role === 'admin')
                        <div class="max-w-5xl mx-auto flex justify-end gap-3">
                            <x-form-a-button href="{{ route('courses.edit', $course->id) }}">Edit</x-form-a-button>

                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this course?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-5 py-2 rounded-xl bg-red-600 text-white font-semibold shadow-lg shadow-red-900/30 hover:bg-red-700 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @elseif($user->role === 'instructor')
                        <div class="max-w-5xl mx-auto flex justify-end">
                            <x-form-a-button href="{{ route('topics.create', $course->id) }}">Add Topic</x-form-a-button>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Reviews -->
            <section class="bg-white/0 py-8 lg:py-16 antialiased">
                <div class="max-w-4xl mx-auto px-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-white">Review</h2>
                    </div>

                    <div class="space-y-4">
                        @foreach($course->comments as $comment)
                            <article class="p-6 text-base rounded-3xl border border-white/10 bg-white/5 backdrop-blur shadow-lg shadow-black/20">
                                <footer class="flex justify-between items-start gap-4 mb-3">
                                    <div class="flex items-center min-w-0">
                                        <img class="mr-3 w-10 h-10 rounded-full ring-2 ring-white/10 object-cover"
                                             src="{{ $comment->user->profile && $comment->user->profile->profile_pic ? asset($comment->user->profile->profile_pic) : asset('images/default.jpg') }}"
                                             alt="Michael Gough">
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

                                    <div class="flex">
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

                                        <textarea name="comment"
                                                  rows="4"
                                                  class="w-full p-3 text-sm text-gray-900 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500"
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

        </div>
    </section>
</x-layout>
