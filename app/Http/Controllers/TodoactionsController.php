<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StatusesController;
use App\User;
use App\Status;
use Illuminate\Support\Facades\DB;

class TodoactionsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$todoactions = DB::select('select id,label,updated_at from todoactions limit 100');
		return view('xxxxxxxxxxxxxxx')->with('todoactions', $todoactions);
	}
	
	//Récupère la liste des todoactions d'une todolist, le noms des users associés et le status des taches
	public function todolistIndex($todolist_id)
	{
		$todoactions = DB::select('SELECT id, label, status_id, updated_at FROM todoactions WHERE todolist_id = ?',
				[$todolist_id]);
		
		foreach ($todoactions as $todoaction)
		{
			//$status = new Status($todoaction->status_id);
			
			//$todoaction->status = $status->label;
			
			$userlist = DB::select('SELECT t1.name FROM users t1 INNER JOIN user_todoaction t2 ON t1.id = t2.user_id WHERE t2.todoaction_id = ?',
					[$todoaction->id]);
			$todoaction->users = array();
			
			foreach ($userlist as $user)
			{
				array_push($todoaction->users, $user);
			}
		}
		
		return view('todoactions')->with(['todoactions' => $todoactions, 'todolist_id' => $todolist_id]);
	}
	
	//Récupère la liste des todoactions d'un user, le noms des users associés et le status des taches
	public function userIndex($user_id)
	{
		$todoactions = DB::select('SELECT t1.id, t1.label, t1.status_id, t1.updated_at FROM todoactions t1 INNER JOIN user_todoaction t2 ON t1.id = t2.user_id WHERE t2.todoaction_id = ?',
				[$user_id]);
		
		foreach ($todoactions as $todoaction)
		{
			//$status = new Status($todoaction->status_id);
			
			//$todoaction->status = $status->label;
			
			$userlist = DB::select('SELECT t1.name FROM users t1 INNER JOIN user_todoaction t2 ON t1.id = t2.user_id WHERE t2.todoaction_id = ?',
					[$todoaction->id]);
			$todoaction->users = array();
			
			foreach ($userlist as $user)
			{
				array_push($todoaction->users, $user);
			}
		}
		
		return view('todoactions')->with('todoactions', $todoactions);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//return view('xxxxxxxxxxxxxxxxxxxxxx');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(TodoactionRequest $request)
	{
		$status_id = StatusesController::getId($request->input('status'));
		DB::insert('insert into todoactions (label, todolist_id, status_id) values (?,?,?)',
				[$request->input('label'), $request->input('todolist_id'), $status_id]);
		DB::insert('insert into user_todoaction (user_id, todolist_id) values (?,?)',
				[$request->input('user_id'), DB::getPdo()->lastInsertId()]);
		return view('xxxxxxxxxxxxxxxx')->with('label', $request->input('label'));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$todoaction = DB::table('todoactions')->where('id', $id)->get();
		return view('xxxxxxxxxxxxxxx')->with('todoaction', $todoaction);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return view('xxxxxxxxxxxxxxxxxxxxx');
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$status_id = StatusesController::getId($request->input('status'));
		DB::table('todolists')->where('id', $id)->update([
				'label' => $request->input('label'),
				'status_id' => $status_id
		]);
		return view('xxxxxxxxxxxxxxxxxx')->with('label', $request->input('label'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		DB::table('todoactions')->where('id', $id)->delete();
		
	}
}
