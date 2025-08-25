

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
            @if($assigned_tasks->count() > 0)
             @foreach($assigned_tasks as $task)
                 <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class=" py-4 flex gap-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    @if($task->images->count() > 0)  
                        @foreach($task->images as $image)
                         <img src="{{asset('storage/' . $image->path)}}" alt="Task Image" class="w-20 h-20 rounded-full  "/>
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
                {{ date('d-m-Y', strtotime($task->created_at)) }}  
                </td>
                 <td class="py-4">
    
    @if($task->status === "in progress")
        <span class="inline-flex items-center rounded-md bg-green-400 px-2 py-1 text-xs font-medium text-white inset-ring inset-ring-gray-500/10">
            {{ $task->status }}
        </span>
    @elseif($task->status === "resolved")
        <span class="inline-flex items-center rounded-md bg-green-900 px-2 py-1 text-xs font-medium text-white inset-ring inset-ring-gray-500/10">
            {{ $task->status }}
        </span>
    @endif
</td>

          
            
                @if($task->status === "resolved")
                   <td class="py-4">
                      <td class="py-4">
                <a href="{{route('manager.show',$task->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
            </td>
                   </td>
                @else
                 
                    <td class="py-4">
                <a  href="{{route('agent.solve',$task->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Solve</a>
            </td>
                @endif
           
     
               
            </tr>
             @endforeach
                
            @else
            <tr>
                <td class="px-6 py-3" colspan="3">
                    No Assigned Tasks available
                </td>
            </tr>
            @endif
       
             
        </tbody>
    </table>
</div>
</x-app-layout>
