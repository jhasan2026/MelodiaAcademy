<script src="https://cdn.tailwindcss.com"></script>
<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="pt-24 pt-8">
            <div class="container px-12 py-12 mx-auto w-1/3 bg-blue-50 rounded-xl">

            <form method="post" action="/register">
                @csrf

                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <x-form-field>
                                <x-form-label for="role">Role</x-form-label>
                                <x-form-input-multi-select id="role" name="role">
                                    <option value="student">Student</option>
                                    <option value="instructor">Instructor</option>
                                </x-form-input-multi-select>
                            </x-form-field>

                            <x-form-field>
                                <x-form-label for="first_name">First Name</x-form-label>

                                <div class="mt-2">
                                    <x-form-input id="first_name"  name="first_name"  required />
                                    <x-form-error name="first_name" />
                                </div>

                            </x-form-field>

                            <x-form-field>
                                <x-form-label for="last_name">Last Name</x-form-label>

                                <div class="mt-2">
                                    <x-form-input id="last_name"  name="last_name"  required />
                                    <x-form-error name="last_name" />
                                </div>

                            </x-form-field>

                            <x-form-field>
                                <x-form-label for="email">Email</x-form-label>

                                <div class="mt-2">
                                    <x-form-input id="email"  name="email"  required />
                                    <x-form-error name="email" />
                                </div>

                            </x-form-field>

                            <x-form-field>
                                <x-form-label for="password">Password</x-form-label>

                                <div class="mt-2">
                                    <x-form-input id="password"  name="password" type="password"  required />
                                    <x-form-error name="password" />
                                </div>

                            </x-form-field>

                            <x-form-field>
                                <x-form-label for="password_confirmation">Confirm Password</x-form-label>

                                <div class="mt-2">
                                    <x-form-input id="password_confirmation"  name="password_confirmation" type="password"  required />
                                    <x-form-error name="password_confirmation" />
                                </div>

                            </x-form-field>

                        </div>

                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6 mr-6">
                    <a href="/"  class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                    <x-form-submit-button>Register</x-form-submit-button>
                </div>
            </form>
        </div>
        </div>
    </section>


</x-layout>
