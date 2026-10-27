<x-layout>
    <x-slot name="nav">
        <x-nav-block>
            <x-nav-link href="{{ route('launch') }}">Return to home page</x-nav-link>
        </x-nav-block>
    </x-slot>
    <div class="flex max-w-xl border-r border-b border-gray-300 m-10 flex-col items-start justify-between">

        <div class="image container">
            @if (filter_var($item->image_path, FILTER_VALIDATE_URL))
                <img src="{{ $item->image_path }}"
                class="max-w-100 max-h-100 object-contain">
            @else
                <img src="{{ asset('storage/' . $item->image_path) }}"
                class="max-w-100 max-h-100 object-contain">
            @endif
        </div>

        <div>
            <!-- Hide scrollbar-->
            <p class="description container">{{ $item->description }}</p>
        </div>

    </div>
    <div class="feed-footer">
        <x-customer-button class="hover:bg-red-100">
            <!--If current customer liked then should be red else it is clear-->
            <x-heroicon-o-heart class="inline h-6 w-6"></x-heroicon-o-heart>
            Like
        </x-customer-button>
        <x-customer-button>Comment</x-customer-button>
        <!-- method should point to the specific customerController for making orders?or order controller depends on you bruv -->
        <form method="#" action="POST" class="order create">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</x-layout>
