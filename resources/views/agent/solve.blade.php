<x-app-layout>
  <div class="max-w-sm min-h-screen flex flex-col justify-center mx-auto  rounded-lg px-4 py-8">
       <h1 class="text-3xl font-bold text-center my-2">Solve The Ticket</h1>
    <form  method="POST" action="{{route('agent.solve',$task->id)}}"  >
    @csrf
    @method('PUT')
  <div class="mb-5">
    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Title</label>
    <input type="text" value="{{ $task->title }}" name="title" id="mytitle" class="bg-gray-50 border border-gray-300 text-slate-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
   </div>
  <div class="mb-5">
    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Description</label>
    <textarea rows="4" name="content" value="{{ $task->content }}" id="mydescription" class="bg-gray-50 border border-gray-300 text-slate-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ $task->content }}</textarea>
   </div>
    <div class="mb-5">
      <div class="mb-5">
 
        @if ($task->images->count() > 0)
          <div class="flex flex-wrap gap-2">
            @foreach ($task->images as $image)
              <img src="{{ asset('storage/' . $image->path) }}" alt="Task Image" class="w-20 h-20 rounded-lg" />
            @endforeach
          </div>
        @else
          <p>No Images Uploaded</p>
        @endif
      </div>
      <div class="my-2">
         <span class="inline-flex items-center rounded-md bg-green-400 px-2 py-1 text-xs font-medium text-white inset-ring inset-ring-gray-500/10">
            {{ $task->status }}
        </span>
      </div>
            
    </div>
  <button type="submit" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm   px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Mark As Solved</button>
</form>
      
  </div>
  
</x-app-layout>
 <script src="{{ asset('js/script.js') }}"></script>