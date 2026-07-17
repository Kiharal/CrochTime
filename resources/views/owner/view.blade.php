<x-layout>
    <x-slot name="nav">
        <x-nav-block>
                <x-nav-link href="#">Check yarn</x-nav-link>
                <x-nav-link href="#">Check sent orders</x-nav-link>
                <x-nav-link href=" {{ route('item.create') }} ">Add new Item</x-nav-link>
                <form method="#" action="POST" class="create">
                    <button >Set working time</button>
                </form>
        </x-nav-block>
    </x-slot>
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