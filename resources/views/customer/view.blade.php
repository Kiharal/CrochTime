<x-layout>
    <x-slot:nav>
        <x-nav-block>
            <x-nav-link>Home</x-nav-link>
        </x-nav-block>
    </x-slot:nav>
    
        <!-- Determine what is in customer nav block -->
        <!-- Must have a cart to redirect to current orders -->
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">USER BLOG PAGE BANNER</h2>
            
        </div>
    
    <div class="bg-white py-24 sm:py-32 ">

    <?php 
      $counter = 1 ;
      $cart_id = 1; 
    ?>
    
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
      @foreach ($items as $item)
        <article class="flex max-w-xl border-r border-b border-gray-300 m-10 flex-col items-start justify-between" data-item="{{ $item }}">
        <div class="flex items-center gap-x-4 text-xs">
          <time datetime="2020-03-16" class="text-gray-500">{{ $item->created_at->format('d M, Y') }}</time>
          <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $item->user->name }}</a>
        </div>
        <div class="group relative grow flex lg:grid-cols-2">
          <div class="relative m-5  w-full  inset-0">
            <img src="https://imgs.search.brave.com/zjyoitHvOa_XmH1Mcd5_pRL6rXlsXrelXGvAa1mAYyk/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuc3F1YXJlc3Bh/Y2UtY2RuLmNvbS9j/b250ZW50L3YxLzYy/ZmU5NTcyMTQ3ZTA3/MTdhNGQ3NGIwNC81/ZDFhMWIwOC1iNDUw/LTQyZmUtYjRiNS0w/M2NhMzBiZGFlODIv/YmVzdHNlbGxpbmcr/Y3JvY2hldCtwcm9k/dWN0cytvbitldHN5/KzgwMC5wbmc" 
            class="w-70 h-40 rounded-md flex-shrink-0">
          </div>
          <div class="text-wrap w-100">
            <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
              <a href="{{ route('item.show', $item) }}">
                <span class="absolute inset-0"></span>
                {{ $item->item_name }}
              </a>
            </h3>
            <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">{{ $item->description }}</p>
          </div>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
          <img src="{{ $item->user->avatar }}" />
          <div class="text-sm/6">
            <p class="font-semibold text-gray-900">
              <a href="#">
                <span class="absolute inset-0"></span>
                {{ $item->user->name }}
              </a>
            </p>
            <p class="text-gray-600">{{ $item->user->role }}</p>
          </div>
        </div>
        <div class="flex items-center gap-x-2 text-s">
          <!--Should be a heart shape, change to red when liked, tied to customer and owner-->
          <x-customer-button>Like</x-customer-button>
          <x-customer-button>Reviews</x-customer-button>
          <x-customer-button class="w-62 inline">

              <button
                class="inline p-2 hover:bg-red-500 rounded-full"
                id="removed"
                data-url="{{ route('cart.remove') }}"
                data-item="{{ $item->id }}">
                  
                  <!-- Minus sign -->
                  <x-heroicon-o-minus-circle class="inline w-6 h-6"/>

              </button>
            <p class="inline">Add to cart</p>
            <p class="inline p-3 text-white rounded-full" id="item_count"></p>

            <button 
              class="inline p-2 hover:bg-green-500 hover:text-white rounded-full"
              id="added"
              data-url="{{ route('cart.add') }}"
              data-item="{{ $item->id }}">
                <x-heroicon-o-plus-circle class="inline w-6 h-6"/>
            </button>
            
          </x-customer-button>
          <!-- with plus image ahead -->
        </div>
      </article>
      @endforeach
      
    </div>
    <!-- Displayed only when data is added in the hidden list below -->
    <x-customer-button id="checkout"
    class="sticky bottom-20 bg-green-700 text-white flex justify-center" 
    href="{{ route('cart.show') }}">
      Checkout
    </x-customer-button>

</x-layout>