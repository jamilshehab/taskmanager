<x-app-layout>
 <div class="relative  ">
    <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class=" p-4 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class=" px-4 py-3">
                    Full Name
                </th>
                <th class="py-3">
                Email
                </th>
                <th class="py-3">
                Role
                </th>
                <th class="py-3">
                   Position
                </th>
               
            </tr>
        </thead>
        <tbody class="p-4">
             @foreach($agents as $agent)
                 <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                 
                <td class=" p-4 ">
                    {{$agent->name}}
                </td>
                 <td class="py-4">
                    {{$agent->email}}
                </td>
                <td class="py-4">
                    {{$agent->role}}
                </td>
                <td class="py-4">
                    {{$agent->job}}
                </td>
                
     
 
          
               
            </tr>
             @endforeach
          
        </tbody>
    </table>
</div> 
</x-app-layout>