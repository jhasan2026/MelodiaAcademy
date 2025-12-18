<select {{ $attributes->merge(['class' => 'form-select w-full bg-white  rounded border border-gray-300 focus:border-gray-100 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 mt-2 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out']) }}
    aria-label="Default select example"
>
    {{ $slot }}
</select>
