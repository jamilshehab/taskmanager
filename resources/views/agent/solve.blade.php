<x-app-layout>
  <div class="max-w-5xl  min-h-screen grid grid-cols-2 gap-4    justify-center mx-auto  rounded-lg px-4 py-8">
    <div class="col">
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
      
            
    </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Solve Task</button>
</form>
    </div>
     <div class="col">
      <h1 class="text-3xl font-bold text-center my-2">Comment</h1>
    <form  method="POST" action="{{route('comments.store',$task->id)}}"  >
    @csrf
    
  <div class="mb-5">
    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment Title</label>
    <input type="text" placeholder="Enter comment title" name="title" id="mytitle" class="bg-gray-50 border border-gray-300 text-slate-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
   </div>
  <div class="mb-5">
    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment Description</label>
    <textarea rows="4" name="body" id="mydescription" class="bg-gray-50 border border-gray-300 text-slate-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="Enter your comment here..."></textarea>
   </div>
   
         
  
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Comment</button>
    </form>
    </div>
  </div>
  
</x-app-layout>
 <script src="{{ asset('js/script.js') }}"></script>