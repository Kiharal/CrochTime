<x-layout>
    <x-slot:nav>
        <x-nav-block></x-nav-block>
    </x-slot:nav>
    <div>
    The tasks are as follows:   
    
    <div class="p-10 place-self-start">
        <x-table-block class=" max-w-full border border-black rounded-t-lg">
            <thead class="block">
                <tr class="block bg-green-400 text-white place-items-center
            grid place-items-center px-5 py-4 shadow-md rounded-t-lg gap-x-10
             grid-cols-1 lg:grid-cols-4">
                    <th>TASK ID</th>
                    <th>Time Fow Work</th>
                    <th>Status</th>
                    <th>State change</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($current as $task)
                <tr class="grid grid-cols-1 border-t border-gray-200 place-items-center
            gap-x-10 lg:grid-cols-4">
                    <td>
                        <a href="#">{{ $task->id }}</a>
                    </td>
                    <td>{{ $task->time_assigned }}</td>
                    <td>{{  $task->status }}</td>
                    <td>
                        <button type="button" id="state-change">
                            Completed
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-table-block>
    </div>
    <div class="p-10">
        Extra
        <x-table-block class="w-full border border-black rounded-t-lg">
            <thead class="block">
                <tr class="block bg-red-400 text-white place-items-center
            grid place-items-center px-5 py-4 shadow-md rounded-t-lg gap-x-10
             grid-cols-1 lg:grid-cols-4">
                    <th>TASK ID</th>
                    <th>Time Fow Work</th>
                    <th>Status</th>
                    <th>State change</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extra as $task)
                <tr class="grid grid-cols-1 border-t border-gray-200 place-items-center
            gap-x-10 lg:grid-cols-4">
                    <td>
                        <a href="#">{{ $task->id }}</a>
                    </td>
                    <td>{{ $task->time_assigned }}</td>
                    <td>{{  $task->status }}</td>
                    <td>
                        <button type="button" id="state-change">
                            Completed
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-table-block>
    </div>
</div>
</x-layout>