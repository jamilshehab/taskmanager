<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 
Route::resource('manager',ManagerController::class)->middleware('auth');
Route::get('manager/assign/{id}',[ManagerController::class,'assign'])->name('manager.assign')->middleware('auth');
Route::put('manager/assign/{id}',[ManagerController::class,'assignTicket'])->name('manager.assignTicket')->middleware('auth');
Route::get('/agent',[AgentController::class,'index'])->name('agent.index')->middleware('auth');
Route::get('/agent/solve/{id}',[AgentController::class,'solve_ticket'])->name('agent.solve_ticket')->middleware('auth');
Route::put('/agent/solve/{id}',[AgentController::class,'solve'])->name('agent.solve')->middleware('auth');
Route::post('/comments/{id}',[CommentController::class,'store'])->name('comments.store')->middleware('auth');
Route::get('/viewComments',[CommentController::class,'index'])->name('comments.index')->middleware('auth');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
