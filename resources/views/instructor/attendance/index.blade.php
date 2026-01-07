{{-- resources/views/instructor/attendance/index.blade.php --}}
<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>
        Attendents
    </x-slot:heading>

    <x-sidenavbar-container>

            <x-sidenavbar :course="$course"></x-sidenavbar>

        <div class="mx-auto w-full max-w-7xl px-6 py-6">

            <!-- Header -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Mark Attendance</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Course: {{ $course->title ?? ('#'.$course->id) }} · Date: {{ $date }}
                    </p>
                </div>

                <form method="GET" class="flex items-end gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Attendance Date
                        </label>
                        <input
                            type="date"
                            name="date"
                            value="{{ $date }}"
                            class="rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        >
                    </div>

                    <button
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        Load
                    </button>
                </form>
            </div>

            <!-- Success -->
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('instructor.attendance.store', $assignedCourse->id) }}">
                @csrf
                <input type="hidden" name="attendance_date" value="{{ $date }}">

                <!-- Session Note -->
                <div class="mb-6 rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Session Note (optional)
                    </label>
                    <textarea
                        name="note"
                        rows="2"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    >{{ old('note', $session->note ?? '') }}</textarea>
                </div>

                <!-- Attendance Card -->
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-200 px-4 py-3">
                        <div class="font-semibold text-gray-900">
                            Approved Students ({{ $students->count() }})
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button type="button"
                                    onclick="setAll('present')"
                                    class="rounded-md bg-green-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-green-700">
                                All Present
                            </button>
                            <button type="button"
                                    onclick="setAll('absent')"
                                    class="rounded-md bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700">
                                All Absent
                            </button>
                            <button type="button"
                                    onclick="setAll('late')"
                                    class="rounded-md bg-yellow-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-yellow-600">
                                All Late
                            </button>
                            <button type="button"
                                    onclick="setAll('excused')"
                                    class="rounded-md bg-gray-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-gray-700">
                                All Excused
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">#</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Student</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Check-in</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600">Remark</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                            @forelse($students as $i => $student)
                                @php
                                    $row = $existing[$student->id] ?? null;
                                    $status = old("attendance.$student->id.status", $row['status'] ?? 'absent');
                                    $remark = old("attendance.$student->id.remark", $row['remark'] ?? '');
                                    $checkIn = old("attendance.$student->id.check_in_time", $row['check_in_time'] ?? '');
                                @endphp

                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $i + 1 }}</td>

                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">
                                            {{ $student->user->first_name }} {{ $student->user->last_name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $student->user->email ?? '' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2" data-attendance-row>
                                            @foreach(['present','absent','late','excused'] as $k)
                                                <label class="cursor-pointer">
                                                    <input
                                                        type="radio"
                                                        class="sr-only status-radio"
                                                        name="attendance[{{ $student->id }}][status]"
                                                        value="{{ $k }}"
                                                        {{ $status === $k ? 'checked' : '' }}
                                                    >
                                                    <span
                                                        class="status-pill inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium
                                                        {{ $status === $k ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}"
                                                        data-status="{{ $k }}"
                                                    >
                                                        {{ ucfirst($k) }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <input
                                            type="time"
                                            name="attendance[{{ $student->id }}][check_in_time]"
                                            value="{{ $checkIn }}"
                                            class="rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                        >
                                    </td>

                                    <td class="px-4 py-3">
                                        <input
                                            type="text"
                                            name="attendance[{{ $student->id }}][remark]"
                                            value="{{ $remark }}"
                                            placeholder="Optional remark"
                                            class="w-full rounded-md border border-gray-300 px-2 py-1 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                        >
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        No approved enrollments found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end border-t border-gray-200 px-4 py-3">
                        <button class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Save Attendance
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            // Tailwind class sets for active/inactive pills
            const ACTIVE = ['bg-blue-600','text-white','border-blue-600'];
            const INACTIVE = ['bg-white','text-gray-700','border-gray-300','hover:bg-gray-100'];

            function updateRowPills(row) {
                const radios = row.querySelectorAll('input.status-radio');
                radios.forEach(radio => {
                    const pill = radio.closest('label')?.querySelector('.status-pill');
                    if (!pill) return;

                    if (radio.checked) {
                        pill.classList.remove(...INACTIVE);
                        pill.classList.add(...ACTIVE);
                    } else {
                        pill.classList.remove(...ACTIVE);
                        pill.classList.add(...INACTIVE);
                    }
                });
            }

            function updateAllRows() {
                document.querySelectorAll('tbody tr').forEach(tr => updateRowPills(tr));
            }

            // Real-time update when a status changes
            document.addEventListener('change', function (e) {
                if (!e.target.classList.contains('status-radio')) return;
                const row = e.target.closest('tr');
                if (row) updateRowPills(row);
            });

            // Bulk set + update UI instantly
            function setAll(status) {
                document.querySelectorAll('tbody tr').forEach(row => {
                    const radio = row.querySelector(`input.status-radio[value="${status}"]`);
                    if (radio) {
                        radio.checked = true;
                        updateRowPills(row);
                    }
                });
            }
            window.setAll = setAll;

            // Ensure initial UI matches checked values
            document.addEventListener('DOMContentLoaded', updateAllRows);
        </script>
    </x-sidenavbar-container>
</x-layout>
