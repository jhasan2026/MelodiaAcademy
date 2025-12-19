<x-layout>
    <x-slot:heading>
        Create Course
    </x-slot:heading>

    <section class="text-gray-600 body-font mb-4">

        <div class="pt-16">
            <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg">
                <div class="px-4 py-2">
                    <h1 class="text-gray-800 font-bold text-2xl uppercase">List of topic</h1>
                </div>
                <form class="w-full max-w-4xl mx-auto px-4 py-2" method="post" action="{{ route('topics.store', $course->id) }}">
                    @csrf
                    <div class="flex items-center border-b-2 border-teal-500 py-2">
                        <input
                            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                            type="text" name="topic" placeholder="Add a topic">
                        <button
                            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                            type="submit">
                            Add
                        </button>
                    </div>
                </form>
                <ul class="divide-y divide-gray-200 px-4">
                    @foreach($course->course_topic()->oldest()->get() as $topic)
                        <x-topic-list>{{ $topic->topic }}</x-topic-list>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="w-full mt-8  flex justify-center">
            <x-form-a-button href="{{ route('courses.index') }}">Save</x-form-a-button>
        </div>

    </section>
</x-layout>
