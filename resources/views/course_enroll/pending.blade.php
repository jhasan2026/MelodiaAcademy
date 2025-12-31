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
                   <h1>Course Found</h1>
                    @endforeach
                @else
                    <p>You are not enrolled in any courses yet.</p>
                @endif
            </div>
        </div>
    </section>


</x-layout>
