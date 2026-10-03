@props(['errors' => ""])
<div>

    <div class="sm:col-span-3">
        {{ $slot }}
    </div>
    <x-errors name="{{ $errors }}"></x-errors>
</div>
    