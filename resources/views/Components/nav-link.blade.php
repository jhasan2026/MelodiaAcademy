

@props(['active' => false])
<a class="{{ $active ? 'rounded-xl  text-xl  text-white bg-orange-950' : 'rounded-md  text-lg text-black hover:rounded-xl  hover:bg-amber-700 hover:text-white' }} px-3 py-2 font-medium"
    {{ $attributes }}
>
    {{ $slot }}
</a>


