<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Courses List
    </x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-16 mx-auto">
            <div class="flex flex-wrap m-4">
                @if($courses->count())
                    @foreach($courses as $course)
                    <a class="p-4 mb-4 md:w-1/3 hover:border hover:border-2 hover:rounded-lg hover:bg-white">
                        <div class="bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                            <img  src="{{ asset('storage/' . $course->instrument_image) }}" class="lg:h-48 md:h-36 w-full object-cover object-center" alt="Your Company" class="size-16" />
                            <div class="p-6 pb-4">
                                <p class="title-font text-2xl font-medium text-gray-900 mb-3">{{ $course->name }}</p>
                                <p class="leading-relaxed mb-3">{{ substr($course->description, 0, 70)}}..</p>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-fg-yellow mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/></svg>
                                        <p class="title-font text-3xl font-medium text-gray-900"> {{ $course->rating  }}</p>
                                    </div>
                                    <div>
                                        <p class="title-font text-3xl font-medium text-gray-900 mb-3">{{ $course->payment  }} Tk</p>
                                        <p class="title-font text-md font-medium text-gray-900 mb-3">{{ $course->course_level  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <p>You are not enrolled in any courses yet.</p>
                @endif
            </div>
        </div>
    </section>


</x-layout>
