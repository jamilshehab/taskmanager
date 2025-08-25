<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Task;
use App\Models\User;
 
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Storage;

class ManagerController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user=auth()->user();
        $user_roles=User::all();
        $this->authorize('viewAnyTasks',Task::class);
        $tasks=Task::where("user_id",$user->id)->paginate();
        $images=Image::all();
         
        $users=User::all();
        return view('manager.task',compact('tasks','users','user_roles'));
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
      
    public function assign(string $id){
       $this->authorize('assign');
       $agents=User::where('role','agent')->get(); 
        $task=Task::findOrFail($id);
       return view('manager.assign',compact('task','agents'));
    }

    public function assignTicket(Request $request, string $id)
    {
        $this->authorize('assign', Task::class);
        $task = Task::findOrFail($id);
        $validated = $request->validate([
            'agents' => 'array|required',
            'agents.*' => 'exists:users,id',
        ]);
        $task->agents()->sync($validated['agents']);
        $task->status='in progress'; 
        $task->save();   
        return redirect()->route('manager.index');
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
        $task=Task::findOrFail($id);
        return view('manager.edit',compact('task'));
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

      
       
        return redirect()->route('manager.index');
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
