<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Create Course
    </x-slot:heading>

    <section class="text-gray-600 body-font mb-4">
        <div class="container px-5 py-10 sm:py-16 mx-auto">
            <div class="lg:w-2/3 w-full mx-auto">
                <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="px-6 sm:px-10 py-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-start justify-between gap-6">
                            <div>
                                <h2 class="text-lg sm:text-xl font-semibold text-gray-900">Course Details</h2>
                                <p class="mt-1 text-sm text-gray-500">Fill in the information below to create a new course.</p>
                            </div>
                            <div class="hidden sm:flex items-center gap-2">
                                <span class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-600 shadow-xs">
                                    New
                                </span>
                            </div>
                        </div>
                    </div>

                    <form action="/courses/" method="post" enctype="multipart/form-data" class="px-6 sm:px-10 py-8">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="relative">
                                <x-form-label for="name">Course Name</x-form-label>
                                <x-form-input id="name" name="name" placeholder="e.g. Violin for winter" required />
                                <x-form-error name="name"/>
                            </div>

                            <div class="relative">
                                <x-form-label for="duration_week">Duration Week</x-form-label>
                                <x-form-input id="duration_week" name="duration_week" type="number" placeholder="e.g. 4" required />
                                <x-form-error name="duration_week"/>
                            </div>

                            <div class="relative sm:col-span-2">
                                <x-form-label for="description">Description</x-form-label>
                                <x-form-text-area id="description" name="description" rows="6" placeholder="Write your thoughts here..."/>
                                <x-form-error name="description"/>
                            </div>

                            <div class="relative">
                                <x-form-label for="instrument_name">Instrument Name</x-form-label>
                                <x-form-input id="instrument_name" name="instrument_name" placeholder="e.g. Violin" required />
                                <x-form-error name="instrument_name"/>
                            </div>

                            <div class="relative">
                                <x-form-label for="payment">Payment (Tk.)</x-form-label>
                                <x-form-input id="payment" name="payment" type="number" placeholder="e.g. 4000" required />
                                <x-form-error name="payment"/>
                            </div>

                            <div class="relative">
                                <x-form-label for="course_level">Course Level</x-form-label>
                                <x-form-input-multi-select id="course_level" name="course_level">
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </x-form-input-multi-select>
                                <x-form-error name="course_level"/>
                            </div>

                            <div class="relative">
                                <x-form-label for="instrument_image">Instrument Image</x-form-label>
                                <div class="mt-2">
                                    <label for="file_input" class="group relative flex items-center justify-between gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-xs transition hover:border-gray-300 hover:shadow-sm">
                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-gray-900">Upload a file</p>
                                            <p class="text-xs text-gray-500 truncate">PNG, JPG up to your server limit</p>
                                        </div>
                                        <span class="inline-flex shrink-0 items-center rounded-lg bg-gray-900 px-3 py-1.5 text-xs font-semibold text-white transition group-hover:bg-gray-800">
                                            Browse
                                        </span>
                                    </label>
                                    <input
                                        class="sr-only"
                                        id="file_input"
                                        type="file"
                                        name="instrument_image"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                            <x-form-cancel-button href="courses/">Cancel</x-form-cancel-button>
                            <x-form-submit-button>Save</x-form-submit-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
