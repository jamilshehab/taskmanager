<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable=['title','content','user_id','department_id'];
    

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function agents(){
        return $this->belongsToMany(User::class,'agent_task');
    }

    
     public function images(){
        return $this->hasMany(Image::class);
     }
     
}

