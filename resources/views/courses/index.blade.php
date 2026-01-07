<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Courses List
    </x-slot:heading>

    <section class="text-gray-600 body-font bg-gradient-to-b from-gray-50 to-white">
        <div class="container px-5 py-16 mx-auto">
            <div class="flex flex-wrap -m-4">

                @foreach($courses as $course)
                    <a href="/courses/{{$course->id}}" class="p-4 md:w-1/3 group">
                        <div class="h-full rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:border-gray-300">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $course->instrument_image) }}"
                                     class="lg:h-48 md:h-36 w-full object-cover object-center transition-transform duration-500 group-hover:scale-[1.03]"
                                     alt="Your Company" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <div class="absolute top-3 right-3">
                                    <div class="flex items-center gap-2 rounded-full bg-white/90 backdrop-blur px-3 py-1 shadow-sm border border-white/60">
                                        <svg class="w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/></svg>
                                        <p class="title-font text-lg font-semibold text-gray-900">{{ $course->rating }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <p class="title-font text-2xl font-semibold text-gray-900 mb-2 tracking-tight line-clamp-1">
                                    {{ $course->name }}
                                </p>
                                <p class="leading-relaxed text-gray-600 mb-4">
                                    {{ substr($course->description, 0, 70)}}..
                                </p>

                                <div class="flex justify-between items-end pt-4 border-t border-gray-100">
                                    <div class="space-y-1">
                                        <p class="title-font text-2xl font-bold text-gray-900">{{ $course->payment }} Tk</p>
                                        <p class="title-font text-sm font-medium text-gray-600">{{ $course->course_level }}</p>
                                    </div>

                                    <div class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900">
                                        <span class="h-9 w-9 rounded-full bg-gray-900 text-white inline-flex items-center justify-center shadow-sm transition-transform duration-300 group-hover:rotate-[-8deg]">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>

            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        </div>
    </section>
</x-layout>
