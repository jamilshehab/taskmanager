<x-app-layout>
  <div class="max-w-sm min-h-screen flex flex-col justify-center mx-auto  rounded-lg px-4 py-8">
    <h1 class="text-3xl font-bold text-center my-2">Create Task</h1>
    <form  method="POST" action="{{route('manager.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="mb-5">
    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Title</label>
    <input type="text" name="title" id="mytitle" class="bg-gray-50 border border-gray-300 text-slate-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
   </div>
  <div class="mb-5">
    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Task Description</label>
    <textarea rows="4" name="content" id="mydescription" class="bg-gray-50 border border-gray-300 text-slate-900 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
   </div>
    <div class="mb-5">
        <input type="file" id="image"
        name="images[]" multiple
        accept="*/images"
        class="w-full text-slate-500 font-medium text-sm bg-gray-100 file:cursor-pointer cursor-pointer file:border-0 file:py-2 file:px-4 file:mr-4 file:bg-gray-800 file:hover:bg-gray-700 file:text-white rounded" />
        <div id="preview-container" class="flex gap-2 flex-wrap mt-4"></div>
        </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
  </div>
  
</x-app-layout>
<script src="{{ asset('js/script.js') }}"></script>