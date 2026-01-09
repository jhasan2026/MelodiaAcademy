<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>Course Attendance</x-slot:heading>

    <x-sidenavbar-container>
        <div class="mx-auto w-full max-w-7xl px-6 py-6">

            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <a href="{{ route('student.attendance.index') }}" class="text-sm text-blue-600 hover:underline">
                        ← Back
                    </a>
                    <h2 class="mt-1 text-xl font-semibold text-gray-900">
                        {{ $course->title ?? ('Course #'.$course->id) }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Progress: <span class="font-semibold text-gray-900">{{ $summary['percent'] }}%</span> ·
                        Total: {{ $summary['total'] }}
                    </p>
                </div>

                <form method="GET" class="flex flex-wrap items-end gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">From</label>
                        <input type="date" name="from" value="{{ $from }}"
                               class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">To</label>
                        <input type="date" name="to" value="{{ $to }}"
                               class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <button class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Filter
                    </button>
                </form>
            </div>

            <div class="mb-6 grid gap-3 sm:grid-cols-4">
                <div class="rounded-xl border bg-white p-4">
                    <div class="text-xs text-gray-500">Present</div>
                    <div class="text-lg font-semibold text-green-700">{{ $summary['present'] }}</div>
                </div>
                <div class="rounded-xl border bg-white p-4">
                    <div class="text-xs text-gray-500">Late</div>
                    <div class="text-lg font-semibold text-yellow-700">{{ $summary['late'] }}</div>
                </div>
                <div class="rounded-xl border bg-white p-4">
                    <div class="text-xs text-gray-500">Excused</div>
                    <div class="text-lg font-semibold text-gray-700">{{ $summary['excused'] }}</div>
                </div>
                <div class="rounded-xl border bg-white p-4">
                    <div class="text-xs text-gray-500">Absent</div>
                    <div class="text-lg font-semibold text-red-700">{{ $summary['absent'] }}</div>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Date</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Check-in</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Remark</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($records as $rec)
                            @php
                                $d = optional($rec->session)->attendance_date?->format('Y-m-d') ?? '';
                                $status = $rec->status;
                                $badge = match($status) {
                                    'present' => 'bg-green-50 text-green-700 border-green-200',
                                    'late' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    'excused' => 'bg-gray-50 text-gray-700 border-gray-200',
                                    default => 'bg-red-50 text-red-700 border-red-200',
                                };
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-gray-900">{{ $d }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-medium {{ $badge }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $rec->check_in_time ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $rec->remark ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    No attendance records found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-4 py-3">
                    {{ $records->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </x-sidenavbar-container>
</x-layout>
