<x-layout>
    <x-slot name="nav">
        <x-nav-block>
                <x-nav-link href="#">Check yarn</x-nav-link>
                <x-nav-link href="#">Check sent orders</x-nav-link>
                <x-nav-link href=" {{ route('item.create') }} ">Add new Item</x-nav-link>
                <form action="{{ route('setTable') }}" method="GET" class="create">
                    <button >Set working time</button>
                </form>
        </x-nav-block>
    </x-slot>
    <x-table-block>
       <thead class="block">
            <tr class="grid place-items-center px-5 py-4 shadow-md rounded-t-lg bg-orange-200 gap-x-10
             grid-cols-1 lg:grid-cols-4">
                <th class="justify-self-start">Order ID</th>
                <th>Order Status</th>
                <th>Due date</th>
                <th>Work remaining</th>
            </tr>
       </thead>
       <tbody class="block">
           @foreach ($tasks as $task)
           <tr class="grid grid-cols-1 border-t border-gray-200 place-items-center
            gap-x-10 lg:grid-cols-4">
            <td class="justify-self-start">CR{{ $task->cart_item_id }}</td>
               <td>
                   <x-task-status status="{{ $task->Status }}">{{$task->Status}}</x-task-status>
               </td>
               <td >{{$task->cartItem->cart->order->due_date}}</td>
               <td >{{ $task->Work_remaining }}</td>
           </tr>
           @endforeach
           
       </tbody>
    </x-table-block>
</x-layout>