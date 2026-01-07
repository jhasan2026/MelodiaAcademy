<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="pt-24 pb-16">
            <div class="mx-auto max-w-lg px-6">
                <div class="rounded-2xl bg-white/80 backdrop-blur border border-white/40 shadow-xl ring-1 ring-black/5">
                    <div class="px-8 pt-8 pb-6 border-b border-gray-200/70">
                        <h2 class="text-2xl font-semibold tracking-tight text-gray-900">Create your account</h2>
                        <p class="mt-1 text-sm text-gray-600">Fill in the details below to register.</p>
                    </div>

                    <form method="post" action="/register" class="px-8 py-8">
                        @csrf

                        <div class="space-y-8">
                            <div class="grid grid-cols-1 gap-6">
                                <x-form-field>
                                    <x-form-label for="role">Role</x-form-label>
                                    <div class="mt-2">
                                        <x-form-input-multi-select id="role" name="role" required>
                                            <option value="">Select role</option>
                                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                                            <option value="instructor" {{ old('role') === 'instructor' ? 'selected' : '' }}>Instructor</option>
                                        </x-form-input-multi-select>
                                        <x-form-error name="role" />
                                    </div>
                                </x-form-field>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <x-form-field>
                                        <x-form-label for="first_name">First Name</x-form-label>
                                        <div class="mt-2">
                                            <x-form-input id="first_name" name="first_name" :value="old('first_name')" required />
                                            <x-form-error name="first_name" />
                                        </div>
                                    </x-form-field>

                                    <x-form-field>
                                        <x-form-label for="last_name">Last Name</x-form-label>
                                        <div class="mt-2">
                                            <x-form-input id="last_name" name="last_name" :value="old('last_name')" required />
                                            <x-form-error name="last_name" />
                                        </div>
                                    </x-form-field>
                                </div>

                                <x-form-field>
                                    <x-form-label for="email">Email</x-form-label>
                                    <div class="mt-2">
                                        <x-form-input id="email" name="email" type="email" :value="old('email')" required />
                                        <x-form-error name="email" />
                                    </div>
                                </x-form-field>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <x-form-field>
                                        <x-form-label for="password">Password</x-form-label>
                                        <div class="mt-2">
                                            <x-form-input id="password" name="password" type="password" required />
                                            <x-form-error name="password" />
                                        </div>
                                    </x-form-field>

                                    <x-form-field>
                                        <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                                        <div class="mt-2">
                                            <x-form-input id="password_confirmation" name="password_confirmation" type="password" required />
                                            <x-form-error name="password_confirmation" />
                                        </div>
                                    </x-form-field>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2">
                                <a href="/" class="text-sm font-semibold text-gray-700 hover:text-gray-900 hover:underline underline-offset-4">
                                    Cancel
                                </a>

                                <x-form-submit-button>
                                    Register
                                </x-form-submit-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
