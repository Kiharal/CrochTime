<x-layout>
    <!-- Customer nav block-->
    <x-slot:nav>
        <x-nav-block></x-nav-block>
    </x-slot:nav>
    <p
      id = "message"
      class="w-screen items-center justify-center flex bg-green-400 text-white px-5">
      <!-- Contains JS live message result -->
    </p>
      @foreach ($cart as $key => $item)
<article class="lg:flex lg:items-center lg:justify-between">
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

        <span class="sm:ml-3">
          <button id="deleteItem"
           data-item="{{ $key }}"
           data-total="{{ $total }}"
           
           class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:cursor-pointer">
            <svg class="text-white rounded-full w-6 h-6" id="#deleteItem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clipRule="evenodd" />
            </svg>
            Delete Item
          </button>
        </span>
    
  </div>
</article>

    @endforeach
    <footer class="bg-green-700 rounded-full flex w-full items-center justify-between">
        <div class="text-white text-xl font-bold bottom-20 text-white flex justify-center mx-auto grid max-w-2xl gap-x-8 gap-y-16 border-t p-10">
            <h1 id="total" data-total="{{ number_format($total) }}">
                Total: Ksh. {{ number_format($total) }}
            </h1>
            
                
        </div>
    </footer>
    <script>

const csrfToken = document.querySelector('meta[name="csrf-token"]').content
async function UpdateCart(url, item, total){
const response = await fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    'X-CSRF-TOKEN': csrfToken},
    body: JSON.stringify({item_id: item, total: total})
})
return response
}

document.addEventListener('click', event => {
        
  const delItem = event.target.closest('#deleteItem')
  if( delItem ){
      let item = delItem.dataset.item
      let total = delItem.dataset.total

      UpdateCart("{{ route('cart.delete') }}", item, total)
      .then(response => {
          if(!response.ok){
              throw new Error('Error on deletion: ' + response.status)
          }
          return response.json()
      })
      .then(data => {
          console.log(data)
          document.getElementById('message').innerHTML = data['message']
          document.getElementById('total').textContent = data['total']
          console.log(data)
      })
      delItem.closest('article').style.display = 'none';
  }
})
    </script>

</x-layout>
