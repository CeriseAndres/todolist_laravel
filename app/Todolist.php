<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = [
        'label', 'updated_at', 'created_at',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function todoactions()
    {
        return $this->hasMany(Todoaction::class);
    }
}
