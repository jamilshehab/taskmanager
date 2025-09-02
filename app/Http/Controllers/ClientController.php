<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Task;
use Illuminate\Http\Request;
use Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->authorize('viewTasks');
        $tasks=Task::where("user_id",auth()->id())->get();
        return view('client.task',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

      
       
        return redirect()->route('manager.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
