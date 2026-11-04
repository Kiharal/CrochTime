<x-layout class="oak-light">
    <div>
        <x-slot:nav>
            <x-nav-block></x-nav-block>
        </x-slot:nav>

        <h1 class="mb-4 text-xl font-semibold">{{ $title }}</h1>
        <div class="container max-w-100">
            <x-form {{ $attributes->merge(['class' => 'rounded-md bg-orange-50 space-y-4']) }}>
                @csrf
                {{ $slot }}
            </x-form>
        </div>
    </div>

</x-layout>
