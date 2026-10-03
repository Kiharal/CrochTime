@props(['size' => 'input'])
<div class="mt-2">
    @if ($size == 'input')
    <input required {{ $attributes->merge(['class'=>'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6']) }}
    />

    @endif
    @if ($size == 'textarea')
    <textarea id="description"
                    required
                    {{ $attributes->merge(['class'=>"block w-full h-64 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"]) }}
            >
            </textarea>
    @endif

    <!-- JS for required -->
</div>    
