<div class=" flex h-screen max-w-[16rem] flex-col  bg-white p-4 text-gray-700 shadow-xl">


    <div class="p-4 mb-2">
        <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
            Sidebar
        </h5>
    </div>
    <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
        {{ $slot }}
    </nav>
</div>
