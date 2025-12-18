@props(['name'])
@error($name)
<div role="alert" class="py-4">
    <div class="bg-red-700 text-white font-bold rounded-b px-4 py-2">
        {{ $message }}
    </div>
</div>

@enderror
