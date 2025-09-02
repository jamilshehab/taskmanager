<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientComntroller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth','verified'])->group(function(){
Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
Route::get('/client', [ClientController::class, 'index'])->name('client.index');

Route::resource('task',TaskController::class)->except(['index']);


Route::get('manager/assign/{id}',[ManagerController::class,'assign'])->name('manager.assign');
Route::put('manager/assign/{id}',[ManagerController::class,'assignTicket'])->name('manager.assignTicket');
Route::get('/agent',[AgentController::class,'index'])->name('agent.index');
Route::get('/agent/solve/{id}',[AgentController::class,'solve_ticket'])->name('agent.solve_ticket');
Route::put('/agent/solve/{id}',[AgentController::class,'solve'])->name('agent.solve');
Route::get('/createComments/{id}',[CommentController::class,'create'])->name('comments.create');
Route::post('/comments/{id}',[CommentController::class,'store'])->name('comments.store');
Route::get('/viewComments',[CommentController::class,'index'])->name('comments.index');
Route::get('/',  [DashboardController::class,'index'])->name('dashboard');
Route::get('/viewUsers',[ManagerController::class,'viewUsers'])->name('manager.viewUsers');
Route::get('/createUsers',[ManagerController::class,'createUser'])->name('manager.createUsers');
Route::post('/createUsers',[ManagerController::class,'store'])->name('manager.store');
Route::resource('department',DepartmentController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
