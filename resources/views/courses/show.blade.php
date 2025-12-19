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
                <div class="flex justify-center">
                    <a
                        class="flex items-center justify-center gap-2 text-white bg-emerald-800 border-0 py-2 px-6 focus:outline-none hover:bg-emerald-600 rounded text-lg">
                        <svg class="w-4 h-4" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>
                        Enroll Now
                    </a>
                </div>
            </div>
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
            <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg">
                <div class="px-4 py-2">
                    <h1 class="text-gray-800 font-bold text-2xl uppercase">List of topic</h1>
                </div>
                <ul class="divide-y divide-gray-200 px-4">
                    @foreach($course->course_topic()->oldest()->get() as $topic)
                        <x-topic-list>{{ $topic->topic }}</x-topic-list>
                    @endforeach
                </ul>
            </div>
        </div>



    </section>
</x-layout>
