<x-layout>
    <x-slot:heading>
        Courses List
    </x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap m-4">

                @foreach($courses as $course)
                    <div class="p-4 md:w-1/3 ">
                        <div class="bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                            <img  src="{{ asset('images/course1.jpg') }}" class="lg:h-48 md:h-36 w-full object-cover object-center" alt="Your Company" class="size-16" />
                            <div class="p-6 pb-4">

                                <p class="title-font text-2xl font-medium text-gray-900 mb-3">{{ $course->name }}</p>
                                <p class="leading-relaxed mb-3">{{ substr($course->description, 0, 70)}}..</p>
                                <div class="flex justify-between items-center">
                                    <p class="title-font text-3xl font-medium text-gray-900 mb-3"> {{ $course->rating  }}</p>
                                    <div>
                                        <p class="title-font text-3xl font-medium text-gray-900 mb-3">{{ $course->payment  }} Tk</p>
                                        <p class="title-font text-md font-medium text-gray-900 mb-3">{{ $course->course_level  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


</x-layout>
