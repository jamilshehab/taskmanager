<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Task;
use Illuminate\Http\Request;
use Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create',Task::class);
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
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
        if(auth()->user()->role === 'client'){
             return redirect()->route('client.index');
        }
        return redirect()->route('manager.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task=Task::findOrFail($id);
        return view('task.details.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update',Task::class);
        $task=Task::findOrFail($id);
        return view('task.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user=auth()->user();
        $task=Task::findOrFail($id);
         $validated=$request->validate([
            'title'=>'string|required',
            'content'=>'string|required',
            'images.*'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

         if(isset($validated['images'])){
          
            foreach ($task->images as $image){
             //first delete the image path 
             Storage::disk('public')->delete($image->path);
             $image->delete();
            }
            //after delete the image from the database and the storage folder 
           
            //create a images 
            
            foreach ($validated['images'] as $image) {
              $path = $image->store('uploads', 'public');
              Image::create([
              'task_id' => $task->id,
              'path' => $path,
             ]);
           }
          }
       $validated['user_id']=$user->id;   

        $task->update($validated);

       if($user->role === 'client'){
           return redirect()->route('client.index');
       }
       return redirect()->route('manager.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task=Task::findOrFail($id);
        $this->authorize('delete', $task);
        
        $task->delete();
        if(auth()->user()->role === 'client'){
            return redirect()->route('client.index');
        }
        return redirect()->route('manager.index');
    }
}
