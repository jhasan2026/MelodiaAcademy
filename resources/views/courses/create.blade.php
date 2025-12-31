<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Create Course
    </x-slot:heading>

    <section class="text-gray-600 body-font mb-4">
        <div class="container px-5 py-16 mx-auto">
            <form action="/courses/" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end pb-4 mb-4">
                    <div class="relative flex-grow w-full mr-6">
                        <x-form-label for="name">Course Name</x-form-label>
                        <x-form-input id="name" name="name" placeholder="e.g. Violin for winter"  required />
                        <x-form-error name="name"/>
                    </div>
                    <div class="relative flex-grow w-full">
                        <x-form-label for="duration_week">Duration Week</x-form-label>
                        <x-form-input id="duration_week" name="duration_week" type="number" placeholder="e.g. 4"  required />
                        <x-form-error name="duration_week"/>
                    </div>
                </div>

                <div class="flex lg:w-2/3 w-full flex-col mx-auto px-2 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-start pb-4 mb-4 ">
                    <x-form-label for="description">Description</x-form-label>
                    <x-form-text-area id="description" name="description" rows="6" placeholder="Write your thoughts here..."/>

                    <x-form-error name="description"/>
                </div>


                <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end pb-4">
                    <div class="relative flex-grow w-full mr-6">
                        <x-form-label for="instrument_name">Instrument Name</x-form-label>
                        <x-form-input id="instrument_name" name="instrument_name" placeholder="e.g. Violin"  required />
                        <x-form-error name="instrument_name"/>
                    </div>
                    <div class="relative flex-grow w-full">
                        <x-form-label for="payment">Payment (Tk.)</x-form-label>
                        <x-form-input id="payment" name="payment" type="number" placeholder="e.g. 4000"  required />
                        <x-form-error name="payment"/>
                    </div>
                </div>

                <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end pb-4">
                    <div class="relative flex-grow w-full mr-6">
                        <x-form-label for="course_level">Course Level</x-form-label>
                        <x-form-input-multi-select id="course_level" name="course_level">
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </x-form-input-multi-select>
                        <x-form-error name="course_level"/>
                    </div>

                    <div class="relative flex-grow w-full mr-6">
                        <x-form-label for="instrument_image">Instrument Image</x-form-label>
                        <input
                            class="cursor-pointer mt-4 bg-white border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"
                            id="file_input"
                            type="file"
                            name="instrument_image"
                        >
                    </div>

                </div>

                <div class="flex justify-center items-center">
                    <div class="text-center my-4 pr-10">
                        <x-form-cancel-button href="courses/">Cancel</x-form-cancel-button>
                    </div>

                    <div class="text-center my-4">
                        <x-form-submit-button>Save</x-form-submit-button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout>
