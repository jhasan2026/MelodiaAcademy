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

                @auth
                    @if($user->role === "student")
                        <div class="flex justify-center">
                            <a href="{{ route('course-enroll.create', $course->id) }}"
                               class="flex items-center justify-center gap-2 text-white bg-emerald-800 border-0 py-2 px-6 focus:outline-none hover:bg-emerald-600 rounded text-lg">
                                <svg class="w-4 h-4" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                                </svg>
                                Enroll Now
                            </a>
                        </div>
                    @endif
                @endauth

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


        <div class="py-16">

            @auth
                @if($user->role === 'admin')
                    <div class="w-7/8 flex justify-end mr-32">
                        <x-form-a-button href="{{ route('courses.edit', $course->id) }}">Edit</x-form-a-button>

                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 mx-4 text-white rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>

                    </div>
                @elseif($user->role === 'instructor')
                    <div class="w-7/8 flex justify-end mr-32">
                        <x-form-a-button href="{{ route('topics.create', $course->id) }}">Add Topic</x-form-a-button>
                    </div>
                @endif
            @endauth
        </div>




    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased mb-4">
      <div class="max-w-4xl mx-auto px-4">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Review</h2>
        </div>

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

                      <div class="flex relative overflow-visible">
                          {{-- Show the Rating --}}
                          <div class="flex mb-2">
                              @for ($i = 1; $i <= 5; $i++)
                                  @if($i <= $comment->rating)
                                      <svg class="w-5 h-5 text-yellow-400 dark:text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                  @else
                                      <svg class="w-5 h-5 text-gray-300 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                      </svg>
                                  @endif
                              @endfor
                          </div>

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
    </section>

</x-layout>



