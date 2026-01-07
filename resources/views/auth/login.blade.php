<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>
        Login
    </x-slot:heading>

    <section class="text-gray-600 body-font">
        <div class="pt-28 pb-20">
            <div class="mx-auto max-w-md rounded-2xl bg-white p-8 shadow-xl ring-1 ring-black/5">

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- EMAIL --}}
                    <x-form-field>
                        <x-form-label for="email">Email</x-form-label>

                        <div class="mt-2">
                            <x-form-input
                                id="email"
                                name="email"
                                type="email"
                                :value="old('email')"
                                required
                                autocomplete="email"
                            />
                            <x-form-error name="email" />
                        </div>
                    </x-form-field>

                    {{-- PASSWORD --}}
                    <x-form-field>
                        <x-form-label for="password">Password</x-form-label>

                        <div class="mt-2">
                            <x-form-input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                            />
                            <x-form-error name="password" />
                        </div>
                    </x-form-field>

                    {{-- ACTIONS --}}
                    <div class="flex items-center justify-between pt-4">
                        <a
                            href="{{ url('/') }}"
                            class="text-sm font-semibold text-gray-600 hover:text-gray-900 hover:underline underline-offset-4"
                        >
                            Cancel
                        </a>

                        <x-form-submit-button>
                            Log in
                        </x-form-submit-button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</x-layout>
