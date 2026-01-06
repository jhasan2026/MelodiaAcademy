<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>Instructor Assigned Courses</x-slot:heading>

    <x-sidenavbar-container>
        <x-sidenavbar :course="$course"></x-sidenavbar>

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 mx-auto">
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

                </section>
            </div>
        </section>
    </x-sidenavbar-container>

</x-layout>
