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
      <div class="max-w-2xl mx-auto px-4">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (20)</h2>
        </div>
        <form class="mb-6">
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" rows="6"
                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                    placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-indigo-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Post comment
            </button>
        </form>
        <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img
                            class="mr-2 w-6 h-6 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                            alt="Michael Gough">Michael Gough</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                            title="February 8th, 2022">Feb. 8, 2022</time></p>
                </div>
                <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                    </svg>
                    <span class="sr-only">Comment settings</span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownComment1"
                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownMenuIconHorizontalButton">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                        </li>
                    </ul>
                </div>
            </footer>
            <p class="text-gray-500 dark:text-gray-400">Very straight-to-point article. Really worth time reading. Thank you! But tools are just the
                instruments for the UX designers. The knowledge of the design tools are as important as the
                creation of the design strategy.</p>

        </article>
      </div>
    </section>



    </section>
</x-layout>
