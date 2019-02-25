<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function todolists()
    {
        return $this->hasMany(Todolist::class);
    }
    public function todoactions()
    {
        return $this->hasMany(Todoaction::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    //Obtenir l'id d'un user
    public function getId($name) {
    	$id = DB::select('select id from users where name = ?', $name);
    	return $id;
    }
}
