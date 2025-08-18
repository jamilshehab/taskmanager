<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable =['task_id','path'];

    public function task(){
        return $this->belongsTo(Task::class);
    }

}
