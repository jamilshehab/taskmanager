

<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Task Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Task Content
                </th>
                <th scope="col" class="px-6 py-3">
                  Task Status   
                </th>
                <th scope="col" class="px-6 py-3">
                   Actions
                </th>
                
            </tr>
        </thead>
        <tbody>
            @if($tasks->count() > 0)
             @foreach($tasks as $task)
             
             @endforeach
                
            @else
            <tr>
                <td class="px-6 py-3" colspan="3">
                    No tasks available
                </td>
            </tr>
            @endif
       
             
        </tbody>
    </table>
</div>
</x-app-layout>
