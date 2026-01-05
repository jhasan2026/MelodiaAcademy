<li class="py-4">
    <div class="flex items-center justigy-center">
        <span class="h-6 w-6 text-3xl text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
           <svg class="w-6 h-6 text-fg-success shrink-0 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        </span>
        <label for="todo1" class="ml-3 block text-gray-900">
            <span class="text-lg font-medium"> {{ $slot }}</span>
        </label>
    </div>
</li>
