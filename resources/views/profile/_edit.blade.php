<x-layout>
    <x-slot:heading>Edit Profile</x-slot:heading>

    <div class="p-6 bg-white rounded shadow">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Profile Picture</label>
                <input type="file" name="profile_pic" class="w-full">
                @if($profile && $profile->profile_pic)
                    <img src="{{ asset($profile->profile_pic) }}" alt="Profile Pic" class="w-24 h-24 rounded mt-2">
                @endif
            </div>

            @if($user->role === 'student')
                <div class="mb-4">
                    <label>Gender</label>
                    <select name="gender" class="w-full border p-2 rounded">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender', $profile->gender) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $profile->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth) }}" class="w-full border p-2 rounded">
                </div>
            @elseif($user->role === 'instructor')
                <div class="mb-4">
                    <label>Bio</label>
                    <textarea name="bio" class="w-full border p-2 rounded">{{ old('bio', $profile->bio) }}</textarea>
                </div>
                <div class="mb-4">
                    <label>Specialization</label>
                    <input type="text" name="specialization" value="{{ old('specialization', $profile->specialization) }}" class="w-full border p-2 rounded">
                </div>
                <div class="mb-4">
                    <label>Experience (years)</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $profile->experience_years) }}" class="w-full border p-2 rounded">
                </div>
            @endif

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Profile</button>
        </form>
    </div>
</x-layout>
