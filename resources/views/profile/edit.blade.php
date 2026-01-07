<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>Edit Profile</x-slot:heading>

    <section class="relative pt-36 pb-24">
        {{-- Cover --}}
        <div class="absolute inset-x-0 top-0 z-0 h-72 overflow-hidden">
            <img
                src="https://pagedone.io/asset/uploads/1705473378.png"
                alt="cover-image"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/35 via-black/25 to-black/70"></div>
            <div class="absolute -bottom-24 left-1/2 h-72 w-[46rem] -translate-x-1/2 rounded-full bg-indigo-500/25 blur-3xl"></div>
            <div class="absolute -top-24 left-1/4 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -top-10 right-10 h-56 w-56 rounded-full bg-indigo-400/15 blur-3xl"></div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="relative z-10">
            @csrf
            @method('PATCH')

            <div class="w-full max-w-7xl mx-auto px-6 md:px-8">
                {{-- Avatar + Upload --}}
                @if($user->role === 'student' | $user->role === 'instructor')
                    <div class="flex items-end justify-center sm:justify-start mb-7">
                        <div class="relative">
                            <div class="absolute -inset-1.5 rounded-full bg-gradient-to-br from-white/70 via-indigo-200/70 to-indigo-600/60 blur-md"></div>
                            <div class="absolute -inset-6 rounded-full bg-indigo-500/10 blur-2xl"></div>

                            <img
                                src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/default.png') }}"
                                alt="user-avatar-image"
                                class="relative h-44 w-44 sm:h-48 sm:w-48 rounded-full object-cover ring-4 ring-white/90 shadow-2xl"
                            />

                            <label for="profile_pic" class="absolute bottom-2 right-2">
                                <input type="file" name="profile_pic" id="profile_pic" class="hidden">
                                <span class="group inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/90 backdrop-blur shadow-lg ring-1 ring-black/10 cursor-pointer transition-all duration-300 hover:bg-white hover:shadow-xl active:scale-95">
                                    <img class="h-5 w-5 opacity-80 group-hover:opacity-100" src="{{ asset('images/camera.png') }}" alt="Upload">
                                </span>
                            </label>

                            <div class="pointer-events-none absolute inset-0 rounded-full ring-1 ring-black/10"></div>
                        </div>
                    </div>
                @endif

                {{-- Header --}}
                <div class="flex flex-col sm:flex-row max-sm:gap-5 items-center justify-between mb-7">
                    <div class="text-center sm:text-left">
                        <h3 class="font-manrope font-bold text-3xl sm:text-4xl text-gray-900 drop-shadow-sm mb-1 tracking-tight">
                            {{ $profile->user->first_name . " " . $profile->user->last_name }}
                        </h3>
                        <p class="text-white/70 text-sm sm:text-base">
                            Update your details and keep your profile up to date.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="rounded-full py-3 px-5 bg-white/90 backdrop-blur flex items-center gap-2 group transition-all duration-300 hover:bg-white shadow-lg shadow-black/10 ring-1 ring-white/40"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path
                                class="stroke-gray-700 transition-all duration-300 group-hover:stroke-indigo-600"
                                d="M14.1667 11.6666V13.3333C14.1667 14.9046 14.1667 15.6903 13.6785 16.1785C13.1904 16.6666 12.4047 16.6666 10.8333 16.6666H7.50001C5.92866 16.6666 5.14299 16.6666 4.65483 16.1785C4.16668 15.6903 4.16668 14.9047 4.16668 13.3333V11.6666M16.6667 9.16663V13.3333M11.0157 10.434L12.5064 9.44014C14.388 8.18578 15.3287 7.55861 15.3287 6.66663C15.3287 5.77466 14.388 5.14749 12.5064 3.89313L11.0157 2.8993C10.1194 2.3018 9.67131 2.00305 9.16668 2.00305C8.66205 2.00305 8.21393 2.3018 7.31768 2.8993L5.82693 3.89313C3.9454 5.14749 3.00464 5.77466 3.00464 6.66663C3.00464 7.55861 3.9454 8.18578 5.82693 9.44014L7.31768 10.434C8.21393 11.0315 8.66205 11.3302 9.16668 11.3302C9.67131 11.3302 10.1194 11.0315 11.0157 10.434Z"
                                stroke="#374151"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />
                        </svg>
                        <span class="font-medium text-base leading-7 text-gray-800 transition-all duration-300 group-hover:text-indigo-600">
                            Role: {{ ucfirst($user->role) }}
                        </span>
                    </button>
                </div>

                {{-- Save --}}
                @if($user->role === 'student' | $user->role === 'instructor')
                    <div class="flex flex-col lg:flex-row max-lg:gap-5 items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button
                                type="submit"
                                class="py-3.5 px-6 rounded-full bg-emerald-500 text-white font-semibold text-base leading-7 shadow-lg shadow-emerald-500/20 transition-all duration-300 hover:bg-emerald-600 hover:shadow-emerald-600/25 active:scale-[0.99] ring-1 ring-white/10"
                            >
                                Save Profile
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="max-w-7xl mt-10">
                    <div class="bg-white/90 backdrop-blur overflow-hidden rounded-2xl border border-white/40 shadow-xl shadow-black/5 ring-1 ring-black/5">
                        <div class="px-5 py-6 sm:px-8 border-b border-gray-200/60 bg-gradient-to-r from-white to-gray-50/60">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-lg leading-6 font-semibold text-gray-900">
                                        User Profile
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-600">
                                        This is some information about the user.
                                    </p>
                                </div>
                                <span class="hidden sm:inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-600 shadow-xs">
                                    Edit
                                </span>
                            </div>
                        </div>

                        <div class="px-5 py-6 sm:px-8">
                            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-6">
                                <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs">
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">First Name</dt>
                                    <dd class="mt-2">
                                        <x-form-input name="first_name" value="{{ old('first_name', $user->first_name) }}"></x-form-input>
                                    </dd>
                                </div>

                                <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs">
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Last Name</dt>
                                    <dd class="mt-2">
                                        <x-form-input name="last_name" value="{{ old('last_name', $user->last_name) }}"></x-form-input>
                                    </dd>
                                </div>

                                <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs sm:col-span-2">
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Email</dt>
                                    <dd class="mt-2">
                                        <x-form-input name="email" value="{{ old('email', $user->email) }}"></x-form-input>
                                    </dd>
                                </div>

                                @if($user->role === 'student')
                                    <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs">
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Gender</dt>
                                        <dd class="mt-2">
                                            <select
                                                name="gender"
                                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200"
                                            >
                                                <option value="">Select</option>
                                                <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </dd>
                                    </div>

                                    <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs">
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Date of Birth</dt>
                                        <dd class="mt-2">
                                            <input
                                                type="date"
                                                name="date_of_birth"
                                                value="2002-01-22"
                                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200"
                                            />
                                        </dd>
                                    </div>

                                @elseif($user->role === 'instructor')
                                    <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs sm:col-span-2">
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Bio</dt>
                                        <dd class="mt-2">
                                            <textarea
                                                name="bio"
                                                class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 shadow-xs transition focus:outline-none focus:ring-2 focus:ring-gray-200"
                                                rows="4"
                                            >{{ old('bio', $profile->bio) }}</textarea>
                                        </dd>
                                    </div>

                                    <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs">
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Specialization</dt>
                                        <dd class="mt-2">
                                            <x-form-input type="text" name="specialization" value="{{ old('specialization', $profile->specialization) }}"></x-form-input>
                                        </dd>
                                    </div>

                                    <div class="rounded-2xl border border-gray-200/70 bg-white px-5 py-4 shadow-xs">
                                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">Experience Years</dt>
                                        <dd class="mt-2">
                                            <x-form-input type="number" name="experience_years" value="{{ old('experience_years', $profile->experience_years) }}"></x-form-input>
                                        </dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-layout>
