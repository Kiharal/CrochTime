@props(['size' => 'input', 'colour' => 'white', 'checked' => false])
<div class="mt-2">
    @if ($size == 'input')
    <input required {{ $attributes->merge(['class'=>'block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6']) }}
    />

    @endif
    @if ($size == 'checkbox')
        <input type="checkbox"
           name="colours[]"
           value="{{ $colour->id }}"
           class="'w-8 h-8 rounded-md bg-white-100 border-black-100 bg-white py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300'"
           @checked($checked)>

        @if ($colour->image_path)
            <img src="{{ asset('storage/' . $colour->image_path) }}" alt=""
                 class=" inline-block h-10 w-10 shrink-0 rounded-md object-cover">
        @endif

        <span class=" inline-block h-10 w-10 rounded-full border border-gray-300
                                     ring-offset-2 peer-checked:ring-2 peer-checked:ring-indigo-600
                                     peer-focus-visible:ring-2 peer-focus-visible:ring-indigo-400
                                     peer-disabled:cursor-not-allowed peer-disabled:opacity-40" 
                                     style="background-color: {{ $colour->color_name }}"></span>

        <span class="text-sm font-medium capitalize">{{ $colour->color_name }}</span>

        <svg class="ml-auto hidden h-5 w-5 text-indigo-600 peer-checked:block"
             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M16.7 5.3a1 1 0 0 1 0 1.4l-7.5 7.5a1 1 0 0 1-1.4 0L3.3 9.7a1 1 0 1 1 1.4-1.4l3.8 3.8 6.8-6.8a1 1 0 0 1 1.4 0z"/>
        </svg>
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
