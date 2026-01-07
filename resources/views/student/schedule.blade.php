<x-layout>
    <x-slot:heading>Weekly Routine</x-slot:heading>

    {{-- FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <div class="space-y-4">

        {{-- Top Controls --}}
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-2">
                <button id="btnPrev" class="px-3 py-2 rounded border text-sm hover:bg-gray-50">Prev</button>
                <button id="btnToday" class="px-3 py-2 rounded border text-sm hover:bg-gray-50">Today</button>
                <button id="btnNext" class="px-3 py-2 rounded border text-sm hover:bg-gray-50">Next</button>
            </div>

            <div class="flex items-center gap-2">
                <button id="btnWeek" class="px-3 py-2 rounded border text-sm hover:bg-gray-50">Week</button>
                <button id="btnDay" class="px-3 py-2 rounded border text-sm hover:bg-gray-50">Day</button>
            </div>
        </div>

        {{-- Calendar Container --}}
        <div class="bg-white border rounded p-3">
            <div id="calendar"></div>
        </div>

        {{-- Simple note --}}
        <p class="text-sm text-gray-500">
            Click any class to see details.
        </p>
    </div>

    {{-- Simple Modal (no extra component needed) --}}
    <div id="eventModal" class="fixed inset-0 hidden items-center justify-center bg-black/40 p-4 z-50">
        <div class="w-full max-w-md bg-white rounded border p-4">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h3 id="mTitle" class="text-lg font-semibold"></h3>
                    <p id="mTime" class="text-sm text-gray-500 mt-1"></p>
                </div>
                <button id="mClose" class="px-2 py-1 rounded border text-sm hover:bg-gray-50">Close</button>
            </div>

            <div class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between gap-3">
                    <span class="text-gray-500">Instrument</span>
                    <span id="mInstrument" class="font-medium"></span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-gray-500">Room</span>
                    <span id="mRoom" class="font-medium"></span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-gray-500">Note</span>
                    <span id="mNote" class="font-medium text-right"></span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-gray-500">Meeting</span>
                    <a id="mLink" class="font-medium text-blue-600 hover:underline" target="_blank"></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const modal = document.getElementById('eventModal');
            const mTitle = document.getElementById('mTitle');
            const mTime = document.getElementById('mTime');
            const mInstrument = document.getElementById('mInstrument');
            const mRoom = document.getElementById('mRoom');
            const mNote = document.getElementById('mNote');
            const mLink = document.getElementById('mLink');

            function openModal(e) {
                const start = e.start ? e.start.toLocaleString() : '';
                const end = e.end ? e.end.toLocaleString() : '';

                mTitle.textContent = e.title || '';
                mTime.textContent = end ? `${start} → ${end}` : start;

                const p = e.extendedProps || {};
                mInstrument.textContent = p.instrument ?? '—';
                mRoom.textContent = p.room_number ? `Room ${p.room_number}` : '—';
                mNote.textContent = p.note ?? '—';

                if (p.meeting_link) {
                    mLink.textContent = p.meeting_link;
                    mLink.href = p.meeting_link;
                    mLink.classList.remove('hidden');
                } else {
                    mLink.textContent = '';
                    mLink.href = '#';
                    mLink.classList.add('hidden');
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.getElementById('mClose').addEventListener('click', closeModal);
            modal.addEventListener('click', (ev) => { if (ev.target === modal) closeModal(); });

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                nowIndicator: true,
                allDaySlot: false,
                height: 'auto',
                slotMinTime: '06:00:00',
                slotMaxTime: '23:00:00',
                headerToolbar: false, // we use our own buttons

                events: {
                    url: "{{ route('student.schedule.events') }}",
                    method: "GET",
                    failure: () => alert('Failed to load schedule'),
                },

                eventClick: function(info) {
                    openModal(info.event);
                },
            });

            calendar.render();

            // Buttons
            document.getElementById('btnPrev').addEventListener('click', () => calendar.prev());
            document.getElementById('btnNext').addEventListener('click', () => calendar.next());
            document.getElementById('btnToday').addEventListener('click', () => calendar.today());
            document.getElementById('btnWeek').addEventListener('click', () => calendar.changeView('timeGridWeek'));
            document.getElementById('btnDay').addEventListener('click', () => calendar.changeView('timeGridDay'));
        });
    </script>
</x-layout>
