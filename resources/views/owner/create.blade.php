<x-layout>
    <x-slot name="nav">
        <x-nav-block>
            
            <x-nav-link href="{{ route('task.index') }}">Check orders</x-nav-link>   
            <button class="create">Set working time</button>
            
        </x-nav-block>
    </x-slot>
    <div class="container">
        <x-form action=" {{ route('item.store') }} " method="POST" enctype="multipart/form-data">
            
            <div>
                <x-form_element errors="image">
                    <x-form-label for="image">Item Image</x-form-label>
                    <x-form-image-in></x-form-image-in>
                    
                </x-form_element>
                <x-form_element errors="'item_name">
                    <x-form-label for="item_name">Item Name</x-form-label>
                    <x-form-input id="item_name" type="text" name="item_name" ></x-form-input>

                </x-form_element>
                
                <x-form_element errors="colours">
                    <x-form-label for="colour-trigger">Select colours</x-form-label>

                    <details class="relative mt-2" id="colour-dropdown">
                        <summary id="colour-trigger"
                                 class="flex cursor-pointer list-none items-center justify-between rounded-md bg-white px-3 py-2 text-sm
                                        outline-1 -outline-offset-1 outline-gray-300 [&::-webkit-details-marker]:hidden">
                            <span><span id="colour-count">0</span> / 10 selected</span>
                            <span aria-hidden="true">▾</span>
                        </summary>
                    
                        <div class="absolute left-0 right-0 z-20 mt-1 max-h-72 overflow-y-auto rounded-md border bg-white p-2 shadow-lg">
                            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                                @foreach ($colours as $colour)
                                    <x-form-input size="checkbox" :colour="$colour"
                                                     :checked="in_array($colour->id, old('colours', []))" />
                                @endforeach
                            </div>
                        </div>
                    </details>
                </x-form_element>
                <x-form_element>
                <details class="relative mt-2">
                        <summary 
                                 class="flex cursor-pointer list-none items-center justify-between rounded-md bg-white px-3 py-2 text-sm
                                        outline-1 -outline-offset-1 outline-gray-300 [&::-webkit-details-marker]:hidden">
                            
                            <span aria-hidden="true">▾</span>
                        </summary>
                    
                        <div class="absolute left-0 right-0 z-20 mt-1 max-h-72 overflow-y-auto rounded-md border bg-white p-2 shadow-lg">
                            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                                @foreach ($categories as $category)
                                    <x-form-input size="radio" :category="$category"
                                    />
                                @endforeach
                            </div>
                        </div>
                    </details>
                </x-form_element>

                <x-form_element errors="description">
                    <x-form-label for="description">Description</x-form-label>
                    <!-- JS for required -->
                    <x-form-input size="textarea" id="description" type="description" name="description" ></x-form-input>
                    
                </x-form_element>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-center gap-x-6">
            <a href="{{ route('launch') }}" class="text-sm/6 font-semibold text-gray-900">Return</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Post Item</button>
        </div>
        </x-form>
    </div>
    <script>
    const MAX = 10;
    const dropdown = document.getElementById('colour-dropdown');
    const boxes = [...document.querySelectorAll('.colour-checkbox')];
    const counter = document.getElementById('colour-count');
    const postBtn = document.getElementById('post-btn'); // add this id to your submit button

    function refresh() {
        const n = boxes.filter(b => b.checked).length;
        counter.textContent = n;
        boxes.forEach(b => { if (!b.checked) b.disabled = n >= MAX; });
        postBtn.disabled = n < 1;
    }
    boxes.forEach(b => b.addEventListener('change', refresh));
    refresh();

    // close on outside click or Escape
    document.addEventListener('click', e => {
        if (dropdown.open && !dropdown.contains(e.target)) dropdown.open = false;
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') dropdown.open = false;
    });
</script>
</x-layout>
