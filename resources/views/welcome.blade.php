<x-layout>
    <x-slot:nav></x-slot:nav>
    <div>
    The tasks are
    @foreach ($tasks as $task)
    {{ $task->id}}
    
    @endforeach
</div>
</x-layout>