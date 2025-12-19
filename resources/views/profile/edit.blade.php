<x-layout>
    <x-slot:heading>Edit Profile</x-slot:heading>
    <section class="relative pt-40 pb-24">
        <img src="https://pagedone.io/asset/uploads/1705473378.png" alt="cover-image" class="w-full absolute top-0 left-0 z-0 h-60 object-cover">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
        <div class="w-full max-w-7xl mx-auto px-6 md:px-8">

            @if($user->role === 'student' | $user->role === 'instructor')
                <div class="flex items-end justify-center sm:justify-start relative z-10 mb-5">
                    <img src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/default.png') }}" alt="user-avatar-image" class="h-48 w-48 border-4 border-solid border-white rounded-full object-cover">
                    <div>
                        <label for="profile_pic">
                            <input type="file" name="profile_pic" id="profile_pic" class="hidden">
                            <img class="h-8 w-8 cursor-pointer" src="{{ asset('images/camera.png') }}" alt="Upload">
                        </label>

                    </div>
                </div>
            @endif


            <div class="flex flex-col sm:flex-row max-sm:gap-5 items-center justify-between mb-5">
                <div class="block">
                    <h3 class="font-manrope font-bold text-4xl text-white mb-1">Emma Smith</h3>
                </div>
                <button
                    class="rounded-full py-3.5 px-5 bg-gray-100 flex items-center group transition-all duration-500 hover:bg-indigo-100 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path class="stroke-gray-700 transition-all duration-500 group-hover:stroke-indigo-600"
                              d="M14.1667 11.6666V13.3333C14.1667 14.9046 14.1667 15.6903 13.6785 16.1785C13.1904 16.6666 12.4047 16.6666 10.8333 16.6666H7.50001C5.92866 16.6666 5.14299 16.6666 4.65483 16.1785C4.16668 15.6903 4.16668 14.9047 4.16668 13.3333V11.6666M16.6667 9.16663V13.3333M11.0157 10.434L12.5064 9.44014C14.388 8.18578 15.3287 7.55861 15.3287 6.66663C15.3287 5.77466 14.388 5.14749 12.5064 3.89313L11.0157 2.8993C10.1194 2.3018 9.67131 2.00305 9.16668 2.00305C8.66205 2.00305 8.21393 2.3018 7.31768 2.8993L5.82693 3.89313C3.9454 5.14749 3.00464 5.77466 3.00464 6.66663C3.00464 7.55861 3.9454 8.18578 5.82693 9.44014L7.31768 10.434C8.21393 11.0315 8.66205 11.3302 9.16668 11.3302C9.67131 11.3302 10.1194 11.0315 11.0157 10.434Z"
                              stroke="#374151" stroke-width="1.6" stroke-linecap="round" />
                    </svg>
                    <span
                        class="px-2 font-medium text-base leading-7 text-gray-700 transition-all duration-500 group-hover:text-indigo-600">Role: {{ ucfirst($user->role) }}
                    </span>
                </button>
            </div>
            @if($user->role === 'student' | $user->role === 'instructor')
                <div class="flex flex-col lg:flex-row max-lg:gap-5 items-center justify-between py-0.5">

                    <div class="flex items-center gap-4">
                        <button type="submit"
                           class="py-3.5 px-5 rounded-full bg-indigo-600 text-white font-semibold text-base leading-7 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-100 hover:bg-indigo-700">Save Profile
                        </button>

                    </div>
                </div>
            @endif

            <div class="max-w-7xl mt-8">
                <div class="bg-white overflow-hidden shadow rounded-lg border">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            User Profile
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            This is some information about the user.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <x-profile-details>
                                <x-profile-details-label>First Name</x-profile-details-label>
                                <x-form-input name="first_name" value="{{ old('first_name', $user->first_name) }}"></x-form-input>
                            </x-profile-details>
                            <x-profile-details>
                                <x-profile-details-label>Last Name</x-profile-details-label>
                                <x-form-input name="last_name" value="{{ old('last_name', $user->last_name) }}"></x-form-input>
                            </x-profile-details>
                            <x-profile-details>
                                <x-profile-details-label>Email</x-profile-details-label>
                                <x-form-input name="email" value="{{ old('email', $user->email) }}"></x-form-input>

                            </x-profile-details>

                            @if($user->role === 'student')

                                <x-profile-details>
                                    <x-profile-details-label>Gender</x-profile-details-label>
                                    <select name="gender" class="form-input">
                                        <option value="">Select</option>
                                        <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </x-profile-details>


                                <x-profile-details>
                                    <x-profile-details-label>Date of Birth</x-profile-details-label>
                                    <input
                                        type="date"
                                        name="date_of_birth"
                                        value="2002-01-22">
                                    </input>
                                </x-profile-details>


                            @elseif($user->role === 'instructor')
                                <x-profile-details>
                                    <x-profile-details-label>Bio</x-profile-details-label>
                                    <textarea name="bio" class="w-full border p-2 rounded">{{ old('bio', $profile->bio) }}</textarea>
                                </x-profile-details>
                                <x-profile-details>
                                    <x-profile-details-label>Specialization</x-profile-details-label>
                                    <x-form-input type="text" name="specialization" value="{{ old('specialization', $profile->specialization) }}"></x-form-input>
                                </x-profile-details>
                                <x-profile-details>
                                    <x-profile-details-label>Experience Years</x-profile-details-label>
                                    <x-form-input type="number" name="experience_years" value="{{ old('experience_years', $profile->experience_years) }}"></x-form-input>
                                </x-profile-details>

                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>

</x-layout>
