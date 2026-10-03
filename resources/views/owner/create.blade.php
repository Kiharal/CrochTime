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
</x-layout>
