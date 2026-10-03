@props(['name'])
@error($name)
            <p class="text-red-600 nt-1 text-semibold">{{ $message }}</p>
@enderror