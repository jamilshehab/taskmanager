

<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class=" px-4 py-3">
                    Image
                </th>
                <th class="py-3">
                    Task Name
                </th>
                <th class="py-3">
                    Task Content
                </th>
                <th class="py-3">
                   Date Posted
                </th>
                <th   class="py-3">
                  Task Status   
                </th>
                
                <th class="py-3">
                   Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @if($tasks->count() > 0)
             @foreach($tasks as $task)
                 <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class=" py-4 flex gap-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    @if($task->images->count() > 0)  
                        @foreach($task->images as $image)
                         <img src="{{asset('storage/' . $image->path)}}" alt="Task Image" class="w-20 h-20 rounded-md  "/>
                          @endforeach
                    @else
                        <td class="px-6 py-3">
                         No Image Displayed 
                        </td>
                    @endif
                  
                </td>
                <td class="py-4">
                    {{$task->title}}
                </td>
                <td class=" py-4">
                    {{Str::limit($task->content,50)}}
                </td>
                <td class="py-4">
                    {{ $task->created_at->format('M d, Y h:i A') }}
                 </td>
                 <td class="py-4">
    @if($task->status === "pending")
        <span class="inline-flex items-center rounded-md bg-yellow-400 px-2 py-1 text-xs font-medium text-white inset-ring inset-ring-gray-500/10">
            {{ $task->status }}
        </span>
    @elseif($task->status === "in progress")
        <span class="inline-flex items-center rounded-md bg-green-400 px-2 py-1 text-xs font-medium text-white inset-ring inset-ring-gray-500/10">
            {{ $task->status }}
        </span>
    @elseif($task->status === "resolved")
        <span class="inline-flex items-center rounded-md bg-green-900 px-2 py-1 text-xs font-medium text-white inset-ring inset-ring-gray-500/10">
            {{ $task->status }}
        </span>
    @endif
</td>
  
           @if($task->status!=="pending")
           <td class="py-4">
                    <a href="{{route('task.show',$task->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
            </td>
            <td class="py-4"></td>
            <td class="py-4"></td>
            <td class="py-4"></td>      
           @endif
              <td class=" py-4 ">
             <a href="{{route('task.edit',$task->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
          </td>
          <td class=" py-4 ">
            <form action="{{route('task.destroy',$task->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
            </form>
          </td>   
            </tr>
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
