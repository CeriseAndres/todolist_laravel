<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //protected $fillable = [
        //'label',
    //];
    public function todoactions()
    {
        return $this->hasMany(Todoaction::class);
    }
}
