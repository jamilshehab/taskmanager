<x-app-layout>
  <div class="max-w-sm min-h-screen flex flex-col justify-center mx-auto  rounded-lg px-4 py-8">
    
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
   
         
  
  <button type="submit" class="text-white w-full  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm    px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Your Comment</button>
    </form>
  </div>
  
</x-app-layout>