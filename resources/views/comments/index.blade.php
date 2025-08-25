

<x-app-layout>
      @if($comments->count() > 0)
       @foreach($comments as $comment)
       @if($comment->user_id == auth()->id())
         <div class="p-4 text-sm text-gray-800 rounded-lg max-w-7xl my-4 bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
         <div class="">
            <span class="font-medium">Comment Title : {{ $comment->title }}</span>
         </div>
         <div class="text-slate-700">
          Comment Body : {{ $comment->body }}
         </div>
         <div class="">
            <span class="font-medium">Posted by:</span> {{ $comment->user->role }} {{ $comment->user->name }}
         </div>
         <div class="">
            <span class="font-medium">Posted on:</span> {{ $comment->created_at->format('M d, Y h:i A') }}
         </div>
        </div>
     
        @else
        <div class="p-4  text-sm text-gray-800 rounded-lg max-w-7xl my-4 bg-blue-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
         <div class="">
            <span class="">Comment Title : {{ $comment->title }}</span>
         </div>
         <div class="text-slate-700">
          Comment Body : {{ $comment->body }}
         </div>
         <div class="">
            <span class="">Posted by:</span> {{ $comment->user->role }} {{ $comment->user->name }}
         </div>
         <div class="">
            <span class="">Posted on:</span> {{ $comment->created_at->format('M d, Y h:i A') }}
         </div>
        </div>
        @endif
       @endforeach
     @endif
    
</x-app-layout>
