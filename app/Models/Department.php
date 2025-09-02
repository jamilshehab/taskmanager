<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable=['title','user_id'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
