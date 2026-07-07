<div>
    @foreach ($posts as $post)
    <div class="post">
        <div class="image">
            <img src="{{ $post->image_path }}"
            aria-placeholder="My image"
            >
        </div>
        <div>
            {{ $post->description }}
        </div>
    </div>    
    @endforeach
</div>
