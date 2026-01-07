<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>

    <div class="w-full min-h-screen bg-slate-950 text-white">
        <!-- HERO -->
        <section class="relative overflow-hidden">
            <!-- Background image -->
            <div
                class="h-[70vh] w-full bg-cover bg-center"
                style="background-image: url('{{ asset('images/Background.jpg') }}');"
            ></div>

            <!-- Dark overlay + subtle gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/55 to-slate-950"></div>

            <!-- Decorative blobs -->
            <div class="pointer-events-none absolute -top-24 -left-24 h-80 w-80 rounded-full bg-teal-400/20 blur-3xl"></div>
            <div class="pointer-events-none absolute top-20 -right-24 h-96 w-96 rounded-full bg-purple-500/20 blur-3xl"></div>

            <!-- Header strip -->
            <div class="absolute top-6 left-1/2 w-[92%] max-w-6xl -translate-x-1/2">
                <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-5 py-4 backdrop-blur-xl">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-teal-400 via-blue-500 to-purple-500 p-[2px]">
                            <div class="flex h-full w-full items-center justify-center rounded-[10px] bg-slate-950">
                                <!-- music icon -->
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 3v10.55A4 4 0 1 0 14 17V7h6V3h-8z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-white/70">Welcome back</p>
                            <h1 class="text-lg font-semibold tracking-wide">Melodia Academy Dashboard</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm hover:bg-white/10">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22a2 2 0 0 0 2-2H10a2 2 0 0 0 2 2zm6-6V11a6 6 0 1 0-12 0v5L4 18v1h16v-1l-2-2z"/></svg>
                            Notifications
                        </button>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-teal-400 via-blue-500 to-purple-500 px-4 py-2 text-sm font-semibold text-slate-950 hover:opacity-95">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5v14m-7-7h14"/></svg>
                            Add Class
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hero content -->
            <div class="absolute inset-0 flex items-center">
                <div class="mx-auto w-[92%] max-w-6xl">
                    <div class="max-w-2xl">
                        <p class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs text-white/80 backdrop-blur">
                            <span class="h-2 w-2 rounded-full bg-teal-400"></span>
                            Turning Passion into Performance
                        </p>

                        <h2 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl">
                            Learn. Practice. Perform.
                            <span class="block bg-gradient-to-r from-teal-300 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                                Melodia Academy
                            </span>
                        </h2>

                        <p class="mt-4 text-base text-white/75 sm:text-lg">
                            Track students, classes, progress, and announcements—all in one beautiful dashboard.
                        </p>

                        <!-- Fancy CTA -->
                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <div class="relative group">
                                <button
                                    class="relative inline-block p-px font-semibold leading-6 text-white bg-gray-800 shadow-2xl cursor-pointer rounded-xl shadow-zinc-900 transition-transform duration-300 ease-in-out hover:scale-105 active:scale-95"
                                >
                                    <span
                                        class="absolute inset-0 rounded-xl bg-gradient-to-r from-teal-400 via-blue-500 to-purple-500 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                    ></span>

                                    <span class="relative z-10 block px-6 py-3 rounded-xl bg-gray-950">
                                        <div class="relative z-10 flex items-center space-x-2">
                                            <span class="transition-all duration-500 group-hover:translate-x-1">Let's get started</span>
                                            <svg
                                                class="w-6 h-6 transition-transform duration-500 group-hover:translate-x-1"
                                                aria-hidden="true"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    clip-rule="evenodd"
                                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                    fill-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </div>
                                    </span>
                                </button>
                            </div>

                            <button class="rounded-xl border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-white hover:bg-white/10">
                                View Schedule
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DASHBOARD CONTENT -->
        <main class="mx-auto w-[92%] max-w-6xl -mt-14 pb-14">
            <!-- Stats -->
            <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Card -->
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                    <p class="text-sm text-white/70">Total Students</p>
                    <div class="mt-2 flex items-end justify-between">
                        <p class="text-3xl font-bold">128</p>
                        <span class="rounded-full bg-teal-400/15 px-3 py-1 text-xs text-teal-200">+12 this month</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                    <p class="text-sm text-white/70">Active Courses</p>
                    <div class="mt-2 flex items-end justify-between">
                        <p class="text-3xl font-bold">14</p>
                        <span class="rounded-full bg-blue-400/15 px-3 py-1 text-xs text-blue-200">3 new</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                    <p class="text-sm text-white/70">Upcoming Classes</p>
                    <div class="mt-2 flex items-end justify-between">
                        <p class="text-3xl font-bold">7</p>
                        <span class="rounded-full bg-purple-400/15 px-3 py-1 text-xs text-purple-200">Today</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                    <p class="text-sm text-white/70">Attendance</p>
                    <div class="mt-2 flex items-end justify-between">
                        <p class="text-3xl font-bold">92%</p>
                        <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs text-emerald-200">On track</span>
                    </div>
                </div>
            </section>

            <!-- Panels -->
            <section class="mt-6 grid gap-4 lg:grid-cols-3">
                <!-- Upcoming -->
                <div class="lg:col-span-2 rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Upcoming Classes</h3>
                        <button class="text-sm text-white/70 hover:text-white">See all</button>
                    </div>

                    <div class="mt-4 space-y-3">
                        <!-- row -->
                        <div class="flex items-center justify-between rounded-xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl bg-teal-400/15 flex items-center justify-center">
                                    <span class="text-teal-200 font-bold">P</span>
                                </div>
                                <div>
                                    <p class="font-semibold">Piano • Intermediate</p>
                                    <p class="text-sm text-white/70">10:00 AM — Room A • Teacher: A. Rahman</p>
                                </div>
                            </div>
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-white/80">32 min</span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl bg-blue-400/15 flex items-center justify-center">
                                    <span class="text-blue-200 font-bold">G</span>
                                </div>
                                <div>
                                    <p class="font-semibold">Guitar • Beginners</p>
                                    <p class="text-sm text-white/70">12:30 PM — Studio 2 • Teacher: S. Khan</p>
                                </div>
                            </div>
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-white/80">2h</span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl border border-white/10 bg-slate-950/40 px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl bg-purple-400/15 flex items-center justify-center">
                                    <span class="text-purple-200 font-bold">V</span>
                                </div>
                                <div>
                                    <p class="font-semibold">Vocal • Performance Lab</p>
                                    <p class="text-sm text-white/70">4:00 PM — Hall • Teacher: N. Das</p>
                                </div>
                            </div>
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-white/80">Later</span>
                        </div>
                    </div>
                </div>

                <!-- Right column -->
                <div class="space-y-4">
                    <!-- Progress -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                        <h3 class="text-lg font-semibold">Monthly Goal</h3>
                        <p class="mt-1 text-sm text-white/70">Complete 40 sessions this month</p>

                        <div class="mt-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-white/80">Progress</span>
                                <span class="font-semibold">28 / 40</span>
                            </div>
                            <div class="mt-2 h-2 w-full rounded-full bg-white/10">
                                <div class="h-2 w-[70%] rounded-full bg-gradient-to-r from-teal-400 via-blue-500 to-purple-500"></div>
                            </div>
                            <p class="mt-3 text-xs text-white/60">You’re doing great—keep the rhythm going.</p>
                        </div>
                    </div>

                    <!-- Announcements -->
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-xl">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold">Announcements</h3>
                            <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-white/70">3</span>
                        </div>

                        <div class="mt-4 space-y-3">
                            <div class="rounded-xl border border-white/10 bg-slate-950/40 p-4">
                                <p class="font-semibold">Winter Recital Registration</p>
                                <p class="mt-1 text-sm text-white/70">Deadline: Jan 15 • Submit performance pieces.</p>
                            </div>
                            <div class="rounded-xl border border-white/10 bg-slate-950/40 p-4">
                                <p class="font-semibold">New Practice Rooms</p>
                                <p class="mt-1 text-sm text-white/70">Studio 3 renovated—book from the schedule page.</p>
                            </div>
                            <div class="rounded-xl border border-white/10 bg-slate-950/40 p-4">
                                <p class="font-semibold">Teacher Workshop</p>
                                <p class="mt-1 text-sm text-white/70">Friday • 6 PM • Hall — pedagogy & performance tips.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-layout>
