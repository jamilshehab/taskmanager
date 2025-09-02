<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function index(){
        $this->authorize('viewAssignedTickets');
        $user=auth()->user();
        $assigned_tasks=$user->assignTasks;
         return view('agent.index',compact('assigned_tasks'));
    }
    
    public function solve_ticket(string $id){
        $task=Task::findOrFail($id);
        return view('agent.solve',compact('task'));
    }
    public function solve(string $id){
        $task=Task::findOrFail($id);
        $task->status='resolved';
        $task->save();
        return redirect()->route('agent.index');
    }
}
