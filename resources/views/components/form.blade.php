<form {{ $attributes->merge(['class' => 'bg-gray-200']) }}>
    @csrf

    <div class="border-b border-gray-900/10 pb-12 items-center border-gray-400 px-2 py-3">
        {{ $slot }}
    </div>
</form>
