<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $department=Department::with('users')->get();
         return view('department.view', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('createDepartments');
        $agents=User::where('role','agent')->get();
    
        return view('department.create',compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         // Create the department first
      $dapartment = Department::create([
        'title' => $request->title,
       
      ]);

//
    // Assign department_id to selected agents (from the form)
    if ($request->has('agents') && count($request->agents) > 0) {
        User::whereIn('id', $request->agents)
            ->update(['department_id' => $dapartment->id]);
    }

    return redirect()->route('department.index');
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
        $department=Department::findOrFail($id);
        $agents=User::where('role','agent')->get();
        return view('department.edit',compact('department','agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $department=Department::findOrFail($id);
         $validation=$request->validate([
            'title'=>'string|required'
         ]);
         if($validation['agents']){
            $department->users()->sync($request->agents);
         }
 
       
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $department=Department::findOrFail($id);
        $department->delete();

        return redirect()->route('department.index');
    }
}
