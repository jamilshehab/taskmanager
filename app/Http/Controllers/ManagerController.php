<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user=auth()->user();
        $this->authorize('viewAnyTasks',Task::class);
        $tasks=Task::where("user_id",$user->id)->paginate();
        $images=Image::all();
         
        $users=User::all();
        return view('manager.task',compact('tasks','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create',Task::class);
        return view('manager.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user=auth()->id();
        $validated=$request->validate([
            'title'=>'string|required',
            'content'=>'string|required',
            'images.*'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
        $validated['user_id'] = $user;
        $task=Task::create($validated);

        if($request->hasFile('images')){
 
            foreach($request->file('images') as $image){
            $path = $image->store('uploads', 'public');
            Image::create([
                    'task_id'=>$task->id,
                    'path'=>$path
            ]);
            }
        }
        return redirect()->route('manager.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tasks=Task::findOrFail($id);
        return view('');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->authorize('delete', Task::class);
        $task=Task::findOrFail($id);
        dd($task);
        $task->delete();
        return redirect()->route('manager.index');
    }
}
