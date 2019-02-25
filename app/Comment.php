<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text', 'user_id', 'todoaction_id', 'updated_at', 'created_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function todoaction()
    {
        return $this->belongsTo(Todoaction::class);
    }
}
