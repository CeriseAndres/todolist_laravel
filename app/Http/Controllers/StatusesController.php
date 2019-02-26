<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusesController extends Controller
{
	public function getId($status)
	{
		$status_id = DB::select('select id from statuses where status = ?', $status);
		return $status_id;
	}
	
    public function getStatus($status_id)
    {
    	$status = DB::select('select label from statuses where id = ?', $status_id);
    	return $status;
    }
}
