<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    protected $fillable = [
        'label',
    ];
    
//     public function __construct ($id)
//     {
//     	$this->id = $id;
//     	$this->label = $this->getLabel();
//     }
    
    public function todoactions()
    {
        return $this->hasMany(Todoaction::class);
    }
    
    //Obtenir le label d'un status
    public function getLabel() {
    	$label = DB::select('select label from statuses where id = ?', [$this->id]);
    	return $label;
    }
}
