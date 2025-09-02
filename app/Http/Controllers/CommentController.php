<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index(){
     $this->authorize('viewComments');
     $comments=Comment::all();
     return view('comments.index',compact('comments'));
    }
  
    public function create(string $id){
        $this->authorize('createComments');
        $task=Task::findOrFail($id);
        return view('comments.comment',compact('task'));
    }
    public function store(Request $request , string $id)
{
    $task=Task::findOrFail($id); 
    $validation=$request->validate([
        'title'=>'required|string|max:255',
        'body'=>'required|string',
     ]);
    $validation['user_id'] = auth()->id();
    $validation['task_id']=$task->id;
    Comment::create($validation);
    return redirect()->route('comments.index');
}

}
