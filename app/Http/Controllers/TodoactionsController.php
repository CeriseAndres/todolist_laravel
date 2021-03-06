<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StatusesController;
use App\User;
use App\Status;
use Illuminate\Support\Facades\DB;
use App\Todoaction;
use App\Http\Requests\TodoactionRequest;

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
		
		$todolist_label = DB::select('SELECT label from todolists where id = ?', [$todolist_id]);
		
		foreach ($todoactions as $todoaction)
		{
			$todoaction->status = DB::select('SELECT label from statuses where id = ?', [$todoaction->status_id]);
			
			$userlist = DB::select('SELECT t1.name FROM users t1 INNER JOIN user_todoaction t2 ON t1.id = t2.user_id WHERE t2.todoaction_id = ?',
					[$todoaction->id]);
			$todoaction->users = array();
			
			foreach ($userlist as $user)
			{
				array_push($todoaction->users, $user);
			}
		}
		
		return view('todolist_detail')->with(['todoactions' => $todoactions, 'todolist_id' => $todolist_id, 'todolist_label' => $todolist_label]);
	}
	
	//Récupère la liste des todoactions d'un user, le noms des users associés et le status des taches
	public function userIndex($user_id)
	{
		$todoactions = DB::select('SELECT t1.id, t1.label, t1.todolist_id, t1.status_id, t1.updated_at FROM todoactions t1 INNER JOIN user_todoaction t2 ON t1.id = t2.todoaction_id WHERE t2.user_id = ?',
				[$user_id]);
		
		foreach ($todoactions as $todoaction)
		{			
			$todoaction->status = DB::select('SELECT label from statuses where id = ?', [$todoaction->status_id]);
			
			$todoaction->todolist = DB::select('SELECT label from todolists where id = ?', [$todoaction->todolist_id]);
			
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
		DB::insert('insert into todoactions (label, todolist_id, created_at, updated_at) values (?,?,?,?)',
				[$request->input('label'), $request->input('todolist_id'), now(), now()]);
		
		DB::insert('insert into user_todoaction (user_id, todoaction_id) values (?,?)',
				[$request->input('user_id'), DB::getPdo()->lastInsertId()]);
		return back()->with('add-ok', __('La tâche '.$request->input('label').' a bien été ajoutée'));
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
		DB::table('todoactions')->where('id', $id)->update([
				'label' => $request->input('label'),
				//'status_id' => $request->input(''),
				'updated_at' => now()
		]);
		return back()->with(['update-ok'=> __('La tâche '.$request->input('label').' a bien été mise à jour')]);
	}
	
	public function updateStatus(Request $request, $id)
	{
		DB::table('todoactions')->where('id', $id)->update([
				'status_id' => $request->input('status_id'),
				'updated_at' => now()
		]);
		return back()->with(['update-ok'=> __('La tâche '.$request->input('label').' a bien été mise à jour')]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Todoaction $todoaction)
	{
		DB::table('user_todoaction')->where('todoaction_id', $todoaction->id)->delete();
		
		$todoaction->delete();
		
		return back()->with(['del-ok'=> __('La tâche '.$todoaction->label.' a bien été supprimée')]);
		
	}
	
	public function deleteUser(Request $request, $id)
	{
		DB::table('user_todoaction')->where('user_id', $request->input('user_id'))->where('todoaction_id', $id)->delete();
		
		return back()->with(['del-ok'=> __('L\'utilisateur a bien été retiré de la tâche')]);
		
	}
}
