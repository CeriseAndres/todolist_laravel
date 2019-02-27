<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusesController extends Controller
{
	public static function getId($status)
	{
		$status_id = DB::select('select id from statuses where status = ?', [$status]);
		return $status_id;
	}
	
    public static function getStatus($status_id)
    {
    	$status = DB::select('select label from statuses where id = ?', [$status_id]);
    	return $status;
    }
}
