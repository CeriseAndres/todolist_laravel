<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todoaction extends Model
{
    protected $fillable = [
        'label', 'status_id', 'user_id', 'todolist_id', 'updated_at', 'created_at',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function todolist()
    {
        return $this->belongsTo(Todolist::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
