@props(['status' => "not-started"])
<div>
    
    @if($status == "pending")
        <p class="pending_task">{{ $slot }}</p>
    
    @elseif($status =="completed")
        <p class="completed_task">{{ $slot }}</p>
    @elseif($status == "not started")
        <p class="not-started">{{ $slot }}</p>
    @else
        <p>{{ $slot }}</p>
    @endif
</div>