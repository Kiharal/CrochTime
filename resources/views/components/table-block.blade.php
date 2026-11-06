<div {{ $attributes->merge(['class'=>'w-full lg:w-3/4 px-4 lg:px-0']) }}>
    <table class="block w-full table-container">
        {{ $slot }}
    </table>
</div>