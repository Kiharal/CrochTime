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
                <div class="sm:col-span-3">
                    <label for="image" class="block text-sm/6 font-medium text-gray-900">Item Image</label>
                    <div class="mt-2">
                        <input type="file"
                        id="image" 
                        name="image"
                        required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        <!-- JS for required -->
                        @error('image')
                        <p class="text-red-600 nt-1 text-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="item_name" class="block text-sm/6 font-medium text-gray-900">Item Name</label>
                    <!-- JS for required -->
                    <div class="mt-2">
                        <input id="item_name" 
                        type="text" 
                        name="item_name" 
                    required
                     class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" >
                     @error('item_name')
                        <p class="text-red-600 nt-1 text-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-3">
                    <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                    <!-- JS for required -->
                    <div class="mt-2">
                        <textarea id="description" 
                        type="description" 
                        name="description" 
                    required
                     class="block w-full h-64 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" >
                    </textarea>
                     @error('description')
                        <p class="text-red-600 nt-1 text-semibold">{{ $message }}</p>
                    @enderror
                </div>
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
