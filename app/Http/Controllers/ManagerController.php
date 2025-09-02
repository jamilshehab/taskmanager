<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Task;
use App\Models\User;
 
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $tasks=Task::all();
        $images=Image::all();
         
        $users=User::all();
        return view('manager.task',compact('tasks','users','user_roles'));
    }
   
    public function viewUsers(){
        $agents=User::where('role','agent')->get();
        return view('manager.user',compact('agents'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
      
    public function assign(string $id){
        $this->authorize('assign');
        $agents=User::with('department')->where('role','agent')->get();
        $task=Task::findOrFail($id);
       return view('manager.assign',compact('task','agents'));
    }

    public function createUser()
    {
        $this->authorize('createUsers');
        return view('manager.create');
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
        return redirect()->route('manager.viewUsers');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validation = $request->validate([
        'name'     => 'string|required',
        'email'    => 'email|required|unique:users,email',
        'job'      => 'string|required',
        'password' => 'string|required|min:8|confirmed',
    ]);

    $validation['password'] = Hash::make($validation['password']);
    $validation['role'] = 'agent'; // force role to agent
    User::create($validation);

    return redirect()->route('manager.viewUsers')
                     ->with('success', 'Agent created successfully.');
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
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
       
    }
}
