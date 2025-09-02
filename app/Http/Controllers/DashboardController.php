<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
       
        $tasks=Task::all()->count();
         return view('dashboard', compact('tasks'));
    }
}
