<x-app-layout>
     <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class=" p-4 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class=" px-4 py-3">
                  Department Title
                </th>
                <th class="py-3">
                 Agents In This Department
                </th>
                 
                  <th class="py-3">
Actions                </th>
                
                
               
            </tr>
        </thead>
        <tbody class="p-4">
             @foreach($department as $dept)
                 <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                 
                <td class=" p-4 ">
                    {{$dept->title}}
                </td>
                 <td class="py-4">
                    @if($dept->users->count()> 0)
                       @foreach($dept->users as $user)
                           <div class="flex gap-4">
                            <h1 class="text-md ">{{$user->name}}</h1>
                           </div>
                       @endforeach
                    @else
                       <div>No Agents Found</div>
                    @endif
                </td>
                <td class=" py-4 ">
             <a href="{{route('department.edit',$dept->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
          </td>
          <td class=" py-4 ">
            <form action="{{route('department.destroy',$dept->id)}}"  method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
            </form>
          </td> 
              
  
               
            </tr>
             @endforeach
          
        </tbody>
    </table>
</x-app-layout>