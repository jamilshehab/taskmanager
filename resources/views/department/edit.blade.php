<x-app-layout>
    <div class="max-w-sm min-h-screen flex flex-col justify-center mx-auto  rounded-lg px-4 py-8">
 <h1 class="text-3xl font-bold text-center my-2">Create Department</h1>

 <form class=" " action="{{ route('department.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-5">
    <label for="department_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Name</label>
    <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Business"  required />
  </div>

   
      <div class="my-5">
  <div x-data="agentFilter({{$agents}})" class="relative w-full max-w-md">
  <!-- Search Input (triggers dropdown) -->
          <div class="relative">
            <input 
      @focus="open=true"
      @blur="filterAgents"
      class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
      placeholder="Assign Agents To This Department..."
    >
         <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
          </div>
   
          </div>
           <template x-for="agent in selectedAgents" :key="agent.id">
            <input type="hidden" name="agents[]" :value="agent.id" />
           </template>
 
            
           
         <div x-show="selectedAgents.length > 0" class="flex flex-wrap gap-2 mt-2">
   <template x-for="agent in selectedAgents">
      <div class="tag-badge inline-flex items-center rounded-md bg-gray-50 px-2 py-3 mx-3 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
        <span x-text="`${agent?.name ?? ''}`"></span>
 
        <button class="mx-2 text-lg items-center flex"  @click="removeSelectedAgents(agent.id)">x</button>
      </div>
 </template> 
  </div>
   
 
  <!-- Dropdown Panel -->
  <div 
    x-show="open"
    @click.away="open = false"
    class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden"
    x-transition
  >
    <!-- Loading State -->
    <template x-if="loading">
      <div class="p-3 text-center text-gray-500">Loading...</div>
    </template>

  </div>

  <!-- Selected Items (Pills) -->

  <div x-show="filteredAgents.length > 0" class="flex flex-wrap gap-2 mt-2">
    <template x-for="agent in filteredAgents" :key="agent.id">
      
      <li class="block w-full px-4 py-3 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100 last:border-b-0"    @click="addSelectedAgents(agent.id)" >
    <div class="flex flex-row min-w-0 gap-2">
        <p class="text-base font-semibold text-gray-900 truncate" x-text="`${agent.name ?? ''} ${agent.job ?? ''} `"></p>
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <p class="text-sm text-gray-600" x-text="agent?.department?.department_name ?? ''"></p>
        </div>
    </div>
      </li>
    </template>
  </div>
   </div>    
    </div>  
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full   px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Department</button>
</form>
    </div>
   
</x-app-layout>

<script src="{{ asset('js/search.js') }}"></script>
