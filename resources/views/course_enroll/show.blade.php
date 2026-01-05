<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Course
    </x-slot:heading>
    <section class="text-white body-font">
        <div class="container mx-auto flex px-5 py-16 md:flex-row flex-col items-start">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                <img class="object-cover object-center rounded" alt="hero" src="{{ asset('storage/' . $course->instrument_image) }}">
            </div>
            <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-write">{{ $course->name }}
                </h1>
                <p class="mb-8 leading-relaxed">{{ $course->description }}</p>
            </div>

        </div>

        <div class="max-w-5xl mx-auto bg-gray-50 shadow-lg rounded-lg mb-6">
            <div class="px-4 py-2">
                <h1 class="text-red-800 font-bold text-2xl ">List of topic</h1>
            </div>
            <ul class="divide-y divide-gray-200 px-4">
                @foreach($course->course_topic()->oldest()->get() as $topic)
                    <x-topic-list>{{ $topic->topic }}</x-topic-list>
                @endforeach
            </ul>
        </div>



        <section class="text-white body-font border-t">
            <div class="container py-16 mx-auto">
                <div class="flex flex-wrap -m-4 text-center">

                    <div class="p-4 sm:w-1/5 w-1/2">
                        <h2 class="title-font font-medium sm:text-6xl text-4xl text-white mb-2">{{ $course->rating }}</h2>
                        <p class="leading-relaxed">Rating</p>
                    </div>
                    <div class="p-4 sm:w-1/5 w-1/2">
                        <h2 class="title-font font-medium sm:text-6xl text-4xl text-white mb-2">{{ $course->payment }} <span class="text-lg"> Tk.</span></h2>
                        <p class="leading-relaxed">Fees</p>
                    </div>

                    <div class="p-4 sm:w-1/5 w-1/2">
                        <h2 class="title-font font-medium sm:text-6xl text-4xl text-white mb-2">{{ $course->instrument_name }}</h2>
                        <p class="leading-relaxed">Instrument Name</p>
                    </div>
                    <div class="p-4 sm:w-1/5 w-1/2">
                        <h2 class="title-font font-medium sm:text-6xl text-4xl text-white mb-2">{{ $course->duration_week }}</h2>
                        <p class="leading-relaxed">Duration Week</p>
                    </div>
                    <div class="p-4 sm:w-1/5 w-1/2">
                        <h2 class="title-font font-medium sm:text-6xl text-4xl text-white mb-2">{{ ucfirst($course->course_level) }}</h2>
                        <p class="leading-relaxed">Courses Level</p>
                    </div>
                </div>
            </div>
        </section>




    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased mb-4">
      <div class="max-w-4xl mx-auto px-4">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Review</h2>
        </div>

          @if(auth()->check())
              <form class="mb-6" action="{{ route('courses.comments.store', $course->id) }}" method="POST">
                  @csrf
                  <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                      <label for="comment" class="sr-only">Your comment</label>
                      <textarea id="comment" name="comment" rows="6"
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                placeholder="Write a comment..." required></textarea>
                  </div>
                  <button type="submit"
                          class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-indigo-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                      Post comment
                  </button>
              </form>
          @endif




          @foreach($course->comments as $comment)
            <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img
                            class="mr-2 w-6 h-6 rounded-full"
                            src="{{ $comment->user->profile && $comment->user->profile->profile_pic ? asset($comment->user->profile->profile_pic) : asset('images/default.jpg') }}"
                            alt="Michael Gough">{{ $comment->user->first_name . " " . $comment->user->last_name }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                            title="February 8th, 2022">{{ $comment->created_at->diffForHumans() }}</time></p>
                </div>
                @if(auth()->id() === $comment->user_id)
                    <button
                        id="dropdownCommentButton-{{ $comment->id }}"
                        data-dropdown-toggle="dropdownComment-{{ $comment->id }}"
                        type="button"
                        class="inline-flex items-center p-2 text-sm font-medium text-gray-500 rounded-lg hover:bg-gray-100"
                    >
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                @endif
                <!-- Dropdown menu -->
                <div
                    id="dropdownComment-{{ $comment->id }}"
                    class="absolute right-0 mt-2 hidden z-50 w-36
                           bg-white rounded-lg shadow-lg
                           divide-y divide-gray-100
                             dark:bg-gray-700 dark:divide-gray-600"
                >
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                        <li>
                            <button
                                type="button"
                                onclick="toggleEdit({{ $comment->id }})"
                                class="block w-full text-left px-4 py-2
                       hover:bg-gray-100 dark:hover:bg-gray-600"
                            >
                                Edit
                            </button>
                        </li>

                        <li>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2
                           hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                >
                                    Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </footer>
                {{-- Comment Text --}}
                <div id="comment-text-{{ $comment->id }}">
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ $comment->comment }}
                    </p>
                </div>

                {{-- Edit Form --}}
                @if(auth()->id() === $comment->user_id)
                    <form id="edit-form-{{ $comment->id }}"
                          action="{{ route('comments.update', $comment->id) }}"
                          method="POST"
                          class="hidden mt-4">
                        @csrf
                        @method('PUT')

                        <textarea name="comment"
                                  rows="4"
                                  class="w-full p-2 text-sm text-gray-800 border rounded-lg "
                                  required>{{ $comment->comment }}</textarea>

                        <div class="flex gap-2 mt-2">
                            <button type="submit"
                                    class="px-3 py-1 text-sm text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                Update
                            </button>

                            <button type="button"
                                    onclick="toggleEdit({{ $comment->id }})"
                                    class="px-3 py-1 text-sm bg-gray-300 rounded hover:bg-gray-400">
                                Cancel
                            </button>
                        </div>
                    </form>
                @endif


            </article>
          @endforeach
      </div>
    </section>


        <script>
            function toggleEdit(commentId) {
                const text = document.getElementById(`comment-text-${commentId}`);
                const form = document.getElementById(`edit-form-${commentId}`);

                text.classList.toggle('hidden');
                form.classList.toggle('hidden');
            }
        </script>

    </section>

</x-layout>



