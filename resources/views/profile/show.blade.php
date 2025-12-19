<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

    <img src="{{ $profile && $profile->profile_pic ? asset($profile->profile_pic) : asset('images/default.png') }}"
         alt="Profile Picture" class="w-32 h-32 rounded-full object-cover">

    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

        @if($user->role === 'student')
            <p><strong>Gender:</strong> {{ $profile->gender ?? 'N/A' }}</p>
            <p><strong>Date of Birth:</strong> {{ $profile->date_of_birth ?? 'N/A' }}</p>
        @elseif($user->role === 'instructor')
            <p><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>
            <p><strong>Specialization:</strong> {{ $profile->specialization ?? 'N/A' }}</p>
            <p><strong>Experience:</strong> {{ $profile->experience_years ?? 'N/A' }} years</p>
        @endif

        <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Edit Profile</a>
    </div>
</x-layout>
