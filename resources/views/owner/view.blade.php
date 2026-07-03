<x-layout>
 <x-table-block>
    <thead>
        <th>Order ID</th>
        <th>Order Status</th>
        <th>Due date</th>
        <th>Work remaining</th>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <td>CR{{ $task->order_id }}</td>
            <td>
                <x-task-status status="{{ $task->Status }}">{{$task->Status}}</x-task-status>
            </td>
            <td >{{$task->created_at}}</td>
            <td >{{ $task->Work_remaining }}</td>
        </tr>
        @endforeach
        
    </tbody>
 </x-table-block>
</x-layout>