<x-layout>
    <!-- Customer nav block-->
    <x-slot:nav>
        <x-nav-block></x-nav-block>
    </x-slot:nav>
    
      @foreach ($cart as $key => $item)
<div class="lg:flex lg:items-center lg:justify-between">
    <div class="relative m-5  w-100  inset-0">
        <img src="https://imgs.search.brave.com/zjyoitHvOa_XmH1Mcd5_pRL6rXlsXrelXGvAa1mAYyk/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuc3F1YXJlc3Bh/Y2UtY2RuLmNvbS9j/b250ZW50L3YxLzYy/ZmU5NTcyMTQ3ZTA3/MTdhNGQ3NGIwNC81/ZDFhMWIwOC1iNDUw/LTQyZmUtYjRiNS0w/M2NhMzBiZGFlODIv/YmVzdHNlbGxpbmcr/Y3JvY2hldCtwcm9k/dWN0cytvbitldHN5/KzgwMC5wbmc" 
        class="w-70 h-40 rounded-md flex-shrink-0">
    </div>
  <div class="min-w-0 flex-1">
    <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ $item['item_name'] }}</h2>
    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
      <div class="mt-2 flex items-center font-bold text-m ">
        Ksh{{ $item['price'] }}
      </div>

      <div class="mt-2 flex items-center text-sm text-gray-500">
        Qty: {{ $item['qty'] }}
      </div>
    </div>
  </div>
  <div class="mt-5 flex lg:mt-0 lg:ml-4">
      <h2  class="inline-flex items-center rounded-md bg-white px-3 py-2 text-2xl font-semibold text-gray-900 shadow-xs">
        Ksh. {{ number_format($item['total']) }}
    </h2>
    </span>

      <button id="addItem" class="inline-flex items-center rounded-full p-2 bg-white w-10 h-10 shadow-xs hover:bg-gray-50">
        <x-heroicon-o-plus-circle class="inline w-6 h-6"/>
      </button>
      
      <button id="removeItem" class="inline-flex items-center rounded-full p-2 bg-white w-10 h-10 shadow-xs hover:bg-gray-50">
          <x-heroicon-o-minus-circle class="inline w-6 h-6"/>
        </button>
        
        <span class="sm:ml-3">
          <button id="deleteItem" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="mr-1.5 -ml-0.5 size-5">
              <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
            </svg>
            Delete Item
          </button>
        </span>
    
  </div>
</div>

    @endforeach
    <footer class="bg-green-700 rounded-full flex w-full items-center justify-between">
        <div class="text-white text-xl font-bold bottom-20 text-white flex justify-center mx-auto grid max-w-2xl gap-x-8 gap-y-16 border-t p-10">
            <h1>
                Total: Ksh. {{ number_format($total) }}
            </h1>
            
                
        </div>
    </footer>

</x-layout>
