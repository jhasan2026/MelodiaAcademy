<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* (kept as-is) */
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";/* ...huge tailwind preflight... */} }
        </style>
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full bg-gray-50 text-gray-900 antialiased">
<div class="min-h-full">
    {{-- Top glow + subtle texture --}}
    <div class="pointer-events-none fixed inset-x-0 top-0 -z-10 h-72 bg-gradient-to-b from-indigo-100/70 via-white to-transparent"></div>

    <nav class="sticky top-0 z-40 border-b border-gray-200/70 bg-white/80 backdrop-blur-xl">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img src="{{ asset('images/LOGO.png') }}" alt="Your Company" class="size-14 rounded-xl ring-1 ring-black/5 shadow-sm" />
                    </div>

                    @php
                        $user = Auth::user();
                    @endphp

                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-2">
                            @if($user === null)
                                <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
                                <x-nav-link href="/courses" :active="request()->is('courses') || request()->is('courses/*')">Course List</x-nav-link>
                                <x-nav-link href="/contact-us" :active="request()->is('contact-us')">Contact Us</x-nav-link>

                            @elseif($user->role === 'student')
                                <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
                                <x-nav-link href="/courses" :active="request()->is('courses') || request()->is('courses/*')">Course List</x-nav-link>
                                <x-nav-link href="/my_course" :active="request()->is('my_course') || request()->is('my_course/*')">My Course</x-nav-link>
                                <x-nav-link href="student/weekly-routine" :active="request()->is('student/weekly-routine')">My Schedule</x-nav-link>
                                <x-nav-link>Chat</x-nav-link>
                                <x-nav-link href="/contact-us" :active="request()->is('contact-us')">Contact Us</x-nav-link>

                            @elseif($user->role === 'instructor')
                                <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
                                <x-nav-link href="/courses" :active="request()->is('courses') || request()->is('courses/*')">Course List</x-nav-link>
                                <x-nav-link href="/instructor_assigned_courses" :active="request()->is('instructor_assigned_courses') || request()->is('instructor_assigned_courses/*')">Assigned Course</x-nav-link>
                                <x-nav-link href="instructor/weekly-routine" :active="request()->is('instructor/weekly-routine')">My Schedule</x-nav-link>
                                <x-nav-link>Chat</x-nav-link>
                                <x-nav-link href="/contact-us" :active="request()->is('contact-us')">Contact Us</x-nav-link>

                            @elseif($user->role === 'admin')
                                <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
                                <x-nav-link href="/courses" :active="request()->is('courses') || request()->is('courses/*') && !request()->is('courses/create')">Course List</x-nav-link>
                                <x-nav-link href="/courses/create" :active="request()->is('courses/create')">New Course</x-nav-link>
                                <x-nav-link href="/assigned-courses" :active="request()->is('assigned-courses') || request()->is('assigned-courses/*')">Assign Course</x-nav-link>
                                <x-nav-link href="/student_enrolment" :active="request()->is('student_enrolment')">Student Enrollment</x-nav-link>
                                <x-nav-link>My Schedule</x-nav-link>
                                <x-nav-link>Chat</x-nav-link>
                                <x-nav-link href="/contact-us" :active="request()->is('contact-us')">Contact Us</x-nav-link>
                            @endif
                        </div>
                    </div>
                </div>

                @guest
                    <div class="hidden md:flex items-center gap-2">
                        <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
                        <x-nav-link href="/register" :active="request()->is('register')">Signup</x-nav-link>
                    </div>
                @endguest

                @auth
                    <div class="hidden md:flex items-center gap-3">
                        @if($user->role === 'student' || $user->role === 'instructor')
                            <a class="mr-1" href="{{ route('profile.show') }}">
                                <img
                                    class="w-10 h-10 rounded-full ring-2 ring-white shadow-md ring-offset-2 ring-offset-white"
                                    src="{{ $user->profile && $user->profile->profile_pic ? asset($user->profile->profile_pic) : asset('images/default.jpeg') }}"
                                    alt="Rounded avatar"
                                >
                            </a>
                        @endif

                        <form action="/logout" method="post">
                            @csrf
                            <x-form-submit-button>Logout</x-form-submit-button>
                        </form>
                    </div>
                @endauth
            </div>

            <el-disclosure id="mobile-menu" hidden class="block md:hidden">
                <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                    <a href="#" aria-current="page" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Team</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Projects</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Calendar</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Reports</a>
                </div>
                <div class="border-t border-gray-200 pt-4 pb-3">
                    <div class="flex items-center px-5">
                        <div class="shrink-0">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-10 rounded-full ring-1 ring-black/10" />
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-900">Tom Cook</div>
                            <div class="text-sm font-medium text-gray-500">tom@example.com</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Your profile</a>
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Settings</a>
                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">Sign out</a>
                    </div>
                </div>
            </el-disclosure>
        </div>
    </nav>

    <header class="relative">
        <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-gray-200/70 bg-white/80 backdrop-blur shadow-sm ring-1 ring-black/5 px-6 py-5">
                <h1 class="text-3xl font-semibold tracking-tight text-gray-900">
                    {{ $heading }}
                </h1>
            </div>
        </div>
    </header>

    <main class="relative">
        <div class="mx-auto max-w-10xl px-4 sm:px-6 lg:px-8">
            <div class="min-h-screen rounded-2xl border border-white/40 bg-gradient-to-b from-white/70 to-white/40 backdrop-blur shadow-xl ring-1 ring-black/5 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </div>
        </div>
    </main>

    <footer class="mt-10 border-t border-gray-200 bg-white">
        <div class="container px-5 py-16 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left md:mt-0 mt-10">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                    <div class="shrink-0">
                        <img src="{{ asset('images/LOGO.png') }}" alt="Your Company" class="size-14 rounded-xl ring-1 ring-black/5 shadow-sm" />
                    </div>
                    <span class="ml-3 text-xl">Tailblocks</span>
                </a>
                <p class="mt-2 text-sm text-gray-500">Air plant banjo lyft occupy retro adaptogen indego</p>
            </div>

            <div class="flex-grow flex flex-wrap md:pr-20 -mb-10 md:text-left text-center order-first">
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10 space-y-2">
                        <li><a class="text-gray-600 hover:text-gray-900">First Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Second Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Third Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Fourth Link</a></li>
                    </nav>
                </div>

                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10 space-y-2">
                        <li><a class="text-gray-600 hover:text-gray-900">First Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Second Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Third Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Fourth Link</a></li>
                    </nav>
                </div>

                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10 space-y-2">
                        <li><a class="text-gray-600 hover:text-gray-900">First Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Second Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Third Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Fourth Link</a></li>
                    </nav>
                </div>

                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10 space-y-2">
                        <li><a class="text-gray-600 hover:text-gray-900">First Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Second Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Third Link</a></li>
                        <li><a class="text-gray-600 hover:text-gray-900">Fourth Link</a></li>
                    </nav>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 border-t border-gray-200">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row items-center gap-3">
                <p class="text-gray-500 text-sm text-center sm:text-left">
                    © 2020 Tailblocks —
                    <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-gray-600 hover:text-gray-900 ml-1" target="_blank">@knyttneve</a>
                </p>

                <span class="inline-flex sm:ml-auto justify-center sm:justify-start gap-3 text-gray-500">
                    <a class="hover:text-gray-900">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="hover:text-gray-900">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                        </svg>
                    </a>
                    <a class="hover:text-gray-900">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="hover:text-gray-900">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
