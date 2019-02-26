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
    
    //Obtenir le label d'un status
    public function getLabel($id) {
    	$label = DB::select('select label from statuses where id = ?', $id);
    	return $label;
    }
}
