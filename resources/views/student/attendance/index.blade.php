<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>My Attendance</x-slot:heading>

    <x-sidenavbar-container>
        <div class="mx-auto w-full max-w-7xl px-6 py-6">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Attendance & Progress</h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $student->user->first_name }} {{ $student->user->last_name }}
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($courses as $course)
                    @php $p = $progress[$course->id] ?? ['percent'=>0,'total'=>0,'present'=>0,'late'=>0,'excused'=>0,'absent'=>0]; @endphp

                    <a href="{{ route('student.attendance.show', $course->id) }}"
                       class="block rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-base font-semibold text-gray-900">
                                    {{ $course->title ?? ('Course #'.$course->id) }}
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    Sessions: {{ $p['total'] }}
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">{{ $p['percent'] }}%</div>
                                <div class="text-xs text-gray-500">Progress</div>
                            </div>
                        </div>

                        <div class="mt-3 h-2 w-full rounded-full bg-gray-100">
                            <div class="h-2 rounded-full bg-blue-600" style="width: {{ min(100, max(0, $p['percent'])) }}%"></div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-2 text-xs">
                            <span class="rounded-full bg-green-50 px-2 py-1 text-green-700">P: {{ $p['present'] }}</span>
                            <span class="rounded-full bg-yellow-50 px-2 py-1 text-yellow-700">L: {{ $p['late'] }}</span>
                            <span class="rounded-full bg-gray-50 px-2 py-1 text-gray-700">E: {{ $p['excused'] }}</span>
                            <span class="rounded-full bg-red-50 px-2 py-1 text-red-700">A: {{ $p['absent'] }}</span>
                        </div>
                    </a>
                @empty
                    <div class="rounded-xl border border-gray-200 bg-white p-6 text-sm text-gray-600">
                        You have no approved enrollments yet.
                    </div>
                @endforelse
            </div>
        </div>
    </x-sidenavbar-container>
</x-layout>
