<x-layout>
    <x-slot name="nav">
        <x-nav-block>
            <x-nav-link href="{{ route('launch') }}">Return to home page</x-nav-link>
        </x-nav-block>
    </x-slot>
    <div class="content container">

        <div class="image container">
            <img src="{{ $item->image_path }}">
        </div>

        <div>
            <!-- Hide scrollbar-->
            <p class="description container">{{ $item->description }}</p>
        </div>

    </div>
    <div class="feed-footer">
        <x-nav-link>Like</x-nav-link>
        <x-nav-link>Comment</x-nav-link>
        <!-- method should point to the specific customerController for making orders?or order controller depends on you bruv -->
        <form method="#" action="POST" class="order create">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</x-layout>
